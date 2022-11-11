<?php
$router->get('/cart', 'App\Controllers\CartController@showCartPage');
$router->post('/cart/add/(\d+)', 'App\Controllers\CartController@create');
$router->post('/cart/edit/(\d+)', 'App\Controllers\CartController@update');
$router->post('/cart/delete/(\d+)', 'App\Controllers\CartController@delete');
$router->post('/cart/order', 'App\Controllers\CartController@order');
$router->get('/cart/edit/(\d+)/(\d+)', 'App\Controllers\CartController@updateProductAmount');