<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return response("", 200)->header('Content-Type', 'text/plain');
});

Route::get('/debug-env', function () {
    return [
        'db_host' => config('database.connections.mysql.host'),
        'db_port' => config('database.connections.mysql.port'),
    ];
});
