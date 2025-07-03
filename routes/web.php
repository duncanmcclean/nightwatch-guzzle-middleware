<?php

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Handler\CurlHandler;
use GuzzleHttp\HandlerStack;
use Illuminate\Support\Facades\Route;
use Laravel\Nightwatch\Facades\Nightwatch;

Route::get('/', function () {
    $stack = new HandlerStack;
    $stack->setHandler(new CurlHandler);

    $stack->push(Nightwatch::guzzleMiddleware());

    $client = new Client(['handler' => $stack]);

    try {
        $client->request('GET', 'https://laravel.com/404');

        dd(
            'Should only get here if the request was successful.',
            'But... it was not and we got here anyway. Something iffy is going on.',
            'Everything works if you comment out the dd.',
        );
    } catch (ClientException) {
        dd('Request failed, as expected.');
    }
});