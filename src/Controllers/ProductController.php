<?php

namespace App\Controllers;

use App\Models\Product;
use App\Models\Catalog;

use App\SessionGuard as Guard;

class ProductController
{
	public function showProductPage()
	{
		$data = [
			'catalogs' => Catalog::all(),
			'products' => Product::allByStatus(),
			'title_start' => 'Tất cả',
			'title_end' => 'Sản phẩm'
		];

		render_view('/product', $data);
	}

	public function showProductByCatalogPage($id)
	{
		$catalog = Catalog::findById($id);
		if (!$catalog) {
			redirect('/errors/404');
		}
		$data = [
			'catalogs' => Catalog::all(),
			'products' => Product::findByCatalog($id),
			'title_start' => 'Sản phẩm',
			'title_end' => $catalog->catalog_name
		];

		render_view('/product', $data);
	}

	public function showProductFeaturedPage()
	{
		$data = [
			'catalogs' => Catalog::all(),
			'products' => Product::findByFeatured(1),
			'title_start' => 'Sản phẩm',
			'title_end' => 'Nổi bật'
		];

		render_view('/product', $data);
	}

	public function showProductDetailPage($id)
	{
		$product = Product::findById($id);
		if (!$product) {
			redirect('/errors/404');
		}
		$data = [
			'catalogs' => Catalog::all(),
			'product' => $product
		];
		render_view('/productDetail', $data);
	}

	public function showAddPage()
	{
		if (!Guard::isUserLoggedIn()) {
			redirect('/errors/404');
		} else {
			$user = Guard::user();
			if ($user->user_id != 1) {
				redirect('/errors/404');
			}
		}
		$data = [
			'error' => session_get_flash('error'),
			'post_url' => '/products',
			'catalogs' => Catalog::all(),
			'products' => Product::all()
		];

		render_view('/addProduct', $data);
	}

	public function create()
	{
		$product = new Product();
		if ($product->fill($_POST, $_FILES)->save(0)) {
			redirect('/products/add');
		}

		$_SESSION['error'] = 'Đã có lỗi xảy ra.';
		redirect('/products/add');
	}

	public function showEditPage($id)
	{
		if (!Guard::isUserLoggedIn()) {
			redirect('/errors/404');
		} else {
			$user = Guard::user();
			if ($user->user_id != 1) {
				redirect('/errors/404');
			}
		}
		$product = Product::findById($id);
		if (!$product) {
			redirect('/errors/404');
		}
		$data = [
			'error' => session_get_flash('error'),
			'post_url' => '/products/edit/' . $id,
			'catalogs' => Catalog::all(),
			'product' => $product,
			'products' => Product::all()
		];

		render_view('/editProduct', $data);
	}

	public function update($id)
	{
		$product = Product::findById($id);
		$old_product = Product::findById($id);
		if ($product && $product->fill($_POST, $_FILES)->save($old_product->product_id)) {
			redirect('/products/add');
		}

		$_SESSION['error'] = 'Đã có lỗi xảy ra.';
		redirect('/products/edit/' . $id);
	}

	public function delete($id)
	{
		$product = Product::findById($id);
		if ($product) {
			unlink('uploads/' . $product->product_img);
			$product->delete();
		}

		redirect('/products/add');
	}
}
