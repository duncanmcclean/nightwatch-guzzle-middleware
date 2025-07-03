<?php

use GuzzleHttp\Exception\ClientException;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $client = new \GuzzleHttp\Client();

    try {
        $client->request('GET', 'https://laravel.com/404');

        dd('Should only get here if the request was successful.');
    } catch (ClientException) {
        dd('Request failed, as expected.');
    }
});