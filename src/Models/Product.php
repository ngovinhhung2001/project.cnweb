<?php

namespace App\Models;

class Product
{
	public int $product_id = -1;
	public string $product_name = '';
	public int $product_price = -1;
	public string $product_img = '';
	public string $product_img_temp = '';
	public string $product_info = '';
	public int $product_status = -1;
	public int $product_featured = -1;
	public int $catalog_id = -1;

	// public function __construct(array $data = [], array $imgdata = [])
	// {
	// 	$this->fill($data, $imgdata);
	// }

	public static function all(): array
	{
		$products = [];

		$query = PDO()->prepare('select * from products');
		$query->execute();
		while ($row = $query->fetch()) {
			$product = new Product();
			$product->fillFromDb($row);
			$products[] = $product;
		}

		return $products;
	}

	public static function allByStatus(): array
	{
		$products = [];

		$query = PDO()->prepare('select * from products where product_status = 1');
		$query->execute();
		while ($row = $query->fetch()) {
			$product = new Product();
			$product->fillFromDb($row);
			$products[] = $product;
		}

		return $products;
	}

	public function save($old_product_id)
	{
		$result = false;

		if ($this->product_id > 0) {
			$product = Product::findById($this->product_id);
			if (!$product || $product->product_id == $old_product_id) {
				move_uploaded_file($this->product_img_temp, 'uploads/' . $this->product_img);
				if ($this->product_img_temp != '') {
					$old_product = Product::findById($this->product_id);
					unlink('uploads/' . $old_product->product_img);

					$query = PDO()->prepare('update products set product_id = :product_id, product_name = :product_name, product_price = :product_price,
					product_img = :product_img, product_info = :product_info, product_status = :product_status, product_featured =:product_featured, 
					catalog_id = :catalog_id where product_id = :product_id_cond');
					$result = $query->execute([
						'product_id' => $this->product_id,
						'product_name' => $this->product_name,
						'product_price' => $this->product_price,
						'product_img' => $this->product_img,
						'product_info' => $this->product_info,
						'product_status' => $this->product_status,
						'product_featured' => $this->product_featured,
						'catalog_id' => $this->catalog_id,
						'product_id_cond' => $old_product_id
					]);
				} else {
					$query = PDO()->prepare('update products set product_id = :product_id, product_name = :product_name, product_price = :product_price, 
					product_info = :product_info, product_status = :product_status, product_featured =:product_featured, catalog_id = :catalog_id 
					where product_id = :product_id_cond');
					$result = $query->execute([
						'product_id' => $this->product_id,
						'product_name' => $this->product_name,
						'product_price' => $this->product_price,
						'product_info' => $this->product_info,
						'product_status' => $this->product_status,
						'product_featured' => $this->product_featured,
						'catalog_id' => $this->catalog_id,
						'product_id_cond' => $old_product_id
					]);
				}
			}
		} else {
			move_uploaded_file($this->product_img_temp, 'uploads/' . $this->product_img);

			$query = PDO()->prepare('insert into 
			products (product_name, product_price, product_img, product_info, product_status, product_featured, catalog_id) 
			values (:product_name, :product_price, :product_img, :product_info, :product_status, :product_featured, :catalog_id)');
			$result = $query->execute([
				'product_name' => $this->product_name,
				'product_price' => $this->product_price,
				'product_img' => $this->product_img,
				'product_info' => $this->product_info,
				'product_status' => $this->product_status,
				'product_featured' => $this->product_featured,
				'catalog_id' => $this->catalog_id
			]);
			if ($result) {
				$this->product_id = PDO()->lastInsertId();
			}
		}
		return $result;
	}

	public function delete()
	{
		$query = PDO()->prepare('delete from products where product_id = :product_id');
		return $query->execute(['product_id' => $this->product_id]);
	}

	public static function findById(int $product_id)
	{
		$query = PDO()->prepare('select * from products where product_id = :product_id');
		$query->execute(['product_id' => $product_id]);
		if ($row = $query->fetch()) {
			$product = new Product();
			$product->fillFromDb($row);
			return $product;
		}
		return null;
	}

	public static function findByCatalog(int $catalog_id)
	{
		$products = [];

		$query = PDO()->prepare('select * from products where catalog_id = :catalog_id and product_status = 1');
		$query->execute(['catalog_id' => $catalog_id]);
		while ($row = $query->fetch()) {
			$product = new Product();
			$product->fillFromDb($row);
			$products[] = $product;
		}

		return $products;
	}

	public static function findByFeatured(int $product_featured)
	{
		$products = [];

		$query = PDO()->prepare('select * from products where product_featured = :product_featured and product_status = 1');
		$query->execute(['product_featured' => $product_featured]);
		while ($row = $query->fetch()) {
			$product = new Product();
			$product->fillFromDb($row);
			$products[] = $product;
		}

		return $products;
	}

	protected function fillFromDb(array $row)
	{
		$this->product_id = $row['product_id'];
		$this->product_name = $row['product_name'];
		$this->product_price = $row['product_price'];
		$this->product_img = $row['product_img'];
		$this->product_info = $row['product_info'];
		$this->product_status = $row['product_status'];
		$this->product_featured = $row['product_featured'];
		$this->catalog_id = $row['catalog_id'];
		return $this;
	}

	public function fill(array $data, array $imgdata)
	{
		$this->product_id = $data['product_id'] ?? 0;
		$this->product_name = $data['product_name'] ?? '';
		$this->product_price = $data['product_price'] ?? 0;
		$this->product_img = time() . '_' . $imgdata['product_img']['name'] ?? '';
		$this->product_img_temp = $imgdata['product_img']['tmp_name'] ?? '';
		$this->product_info = $data['product_info'] ?? '';
		$this->product_status = $data['product_status'] ?? 0;
		$this->product_featured = $data['product_featured'] ?? 0;
		$this->catalog_id = $data['catalog_id'] ?? 0;
		return $this;
	}
}
