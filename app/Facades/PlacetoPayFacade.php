<?php


namespace App\Facades;


use Dnetix\Redirection\PlacetoPay;

class PlacetoPayFacade
{
    public static function get()
    {
        $config = config('services.placetoPay');

        return new PlacetoPay([
            'login' => $config['login'],
            'tranKey' => $config['secretKey'],
            'url' => $config['url'],
            'type' => PlacetoPay::TP_REST
        ]);
    }
}
