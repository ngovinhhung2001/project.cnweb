<?php
$router->get('/catalogs/add', 'App\Controllers\CatalogController@showAddPage');
$router->post('/catalogs/add', 'App\Controllers\CatalogController@create');
$router->get('/catalogs/edit/(\d+)', 'App\Controllers\CatalogController@showEditPage');
$router->post('/catalogs/edit/(\d+)', 'App\Controllers\CatalogController@update');
$router->get('/catalogs/delete/(\d+)', 'App\Controllers\CatalogController@delete');