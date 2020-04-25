<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LanguageController extends Controller
{
    public function set($locale) {
        if (!array_key_exists($locale, config('app.locales'))) {
            $locale = config('app.fallback_locale');
        }
        if ('local' === env('APP_ENV', 'none')) {
            Cache::forget("lang-{$locale}.js");
        }

        $strings = Cache::rememberForever("lang-{$locale}.js", function () use ($locale) {
            $dir = resource_path('lang/'.$locale);
            $strings = [];
            function recursiveGetLangFiles($dir, &$strings)
            {
                $dir = glob($dir.'/*');
                foreach ($dir as $file) {
                    if (is_file($file)) {
                        $strings[basename($file, '.php')] = require $file;
                    } elseif (is_dir($file)) {
                        recursiveGetLangFiles($file, $strings[basename($file)]);
                    }
                }
            }
            recursiveGetLangFiles($dir, $strings);

            return $strings;
        });

        $contents = 'window.i18n = '.json_encode($strings, config('app.debug', false) ? JSON_PRETTY_PRINT : 0).';';

        return  response($contents, 200, ['Content-Type' => 'text/javascript']);
    }
}
