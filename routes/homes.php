<?php

$router->get('/', 'App\Controllers\HomeController@showHomePage');
$router->get('/home', 'App\Controllers\HomeController@showHomePage');

$router->get('/admin', 'App\Controllers\HomeController@showAdminPage');

$router->post('/close', 'App\Controllers\HomeController@closeModal');

