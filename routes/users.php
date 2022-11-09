<?php
$router->get('/login', 'App\Controllers\UserController@showLoginPage');
$router->post('/login', 'App\Controllers\UserController@login');

$router->get('/register', 'App\Controllers\UserController@showRegisterPage');
$router->post('/register', 'App\Controllers\UserController@register');

$router->post('/logout', 'App\Controllers\UserController@logout');

$router->get('/users/bills', 'App\Controllers\UserController@showUserBillPage');
$router->get('/users/bills/(\d+)', 'App\Controllers\UserController@showUserBillDetailPage');