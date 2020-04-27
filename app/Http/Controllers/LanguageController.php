<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Cache;

class LanguageController extends Controller
{
    public function set($locale)
    {
        $locale = $this->getLocaleFallbackIfNotDefined($locale);

        $this->forgetCacheIfInLocalEnv($locale);

        $langCached = Cache::rememberForever("lang-{$locale}.js", function () use ($locale) {
            $langDirectory = resource_path('lang/'.$locale);
            return $this->recursiveGetLangFiles($langDirectory);
        });

        $contents = $this->getI18nEncode($langCached);

        return  response($contents, 200, ['Content-Type' => 'text/javascript']);
    }

    private function getLocaleFallbackIfNotDefined($locale)
    {
        if (!array_key_exists($locale, config('app.locales'))) {
            $locale = config('app.fallback_locale');
        }
        return $locale;
    }

    private function forgetCacheIfInLocalEnv($locale): void
    {
        if ('local' === env('APP_ENV', 'none')) {
            Cache::forget("lang-{$locale}.js");
        }
    }

    private function recursiveGetLangFiles($langDirectory, $languagesFilesToCache = []): array
    {
        $directory = glob($langDirectory.'/*');

        foreach ($directory as $file) {
            if (is_file($file)) {
                $languagesFilesToCache[basename($file, '.php')] = require $file;
            } elseif (is_dir($file)) {
                $this->recursiveGetLangFiles($file, $languagesFilesToCache[basename($file)]);
            }
        }

        return $languagesFilesToCache;
    }

    private function getI18nEncode($langCached): string
    {
        return sprintf('window.i18n = %s;', json_encode(
            $langCached,
            config('app.debug', false) ? JSON_PRETTY_PRINT : 0
        ));
    }
}
