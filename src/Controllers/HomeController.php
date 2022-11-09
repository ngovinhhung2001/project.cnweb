<?php

namespace App\Controllers;

use App\Models\Catalog;
use App\Models\Product;


class HomeController
{
	public function showHomePage()
	{
		render_view('home', [
			'catalogs' => Catalog::all(),
			'products' => Product::findByFeatured(1)
		]);
	}

	public function showAdminPage()
	{
		render_view('admin', [
			'catalogs' => Catalog::all()
		]);
	}

	public function showError404Page()
	{
		render_view('error404');
	}

	public function closeModal()
	{
		unset($_SESSION['message']);
		$modalURI = $_SESSION['modalURI'];
		unset($_SESSION['modalURI']);
		redirect($modalURI);
	}
}
