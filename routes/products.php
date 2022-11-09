<?php
$router->get('/products/add', 'App\Controllers\ProductController@showAddPage');
$router->post('/products/add', 'App\Controllers\ProductController@create');
$router->get('/products/edit/(\d+)', 'App\Controllers\ProductController@showEditPage');
$router->post('/products/edit/(\d+)', 'App\Controllers\ProductController@update');
$router->get('/products/delete/(\d+)', 'App\Controllers\ProductController@delete');

$router->get('/products', 'App\Controllers\ProductController@showProductPage');
$router->get('/products/(\d+)', 'App\Controllers\ProductController@showProductByCatalogPage');
$router->get('/products/featured', 'App\Controllers\ProductController@showProductFeaturedPage');
$router->get('/products/detail/(\d+)', 'App\Controllers\ProductController@showProductDetailPage');