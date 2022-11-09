<?php
$router->get('/bills', 'App\Controllers\BillController@showBillPage');
$router->get('/bills/(\d+)', 'App\Controllers\BillController@showBillDetailPage');