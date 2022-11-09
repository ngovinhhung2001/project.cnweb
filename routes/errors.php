<?php

class ErrorController
{
	function pageNotFound()
	{
		http_response_code(404);
		echo '<!DOCTYPE html>
		<html lang="en">
		
		<head>
			<meta charset="UTF-8">
			<meta http-equiv="X-UA-Compatible" content="IE=edge">
			<meta name="viewport" content="width=device-width, initial-scale=1.0">
			<title>HK - MilkTea & Tea</title>
			<link rel="icon" href="/img/icon.png" />
			<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" />
			<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" />
			<link rel="stylesheet" href="/css/main.css"/>
		</head>
		
		<body>
			<div class="bg-pink fs-4r fw-bold  text-dark-pink text-uppercase" style="height: 100vh;">
				<p class="text-center" style="padding-top: 20%;">404 Page Not Found </p>
			</div>
		</body>
		
		</html>';
	}
}

$router->set404('ErrorController@pageNotFound');
