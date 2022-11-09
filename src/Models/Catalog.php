<?php

namespace App\Models;

class Catalog
{
	public int $catalog_id = -1;
	public string $catalog_name = '';

	public static function all(): array
	{
		$catalogs = [];

		$query = PDO()->prepare('select * from catalogs');
		$query->execute();
		while ($row = $query->fetch()) {
			$catalog = new Catalog();
			$catalog->fillFromDb($row);
			$catalogs[] = $catalog;
		}

		return $catalogs;
	}

	public function save(int $old_catalog_id)
	{
		$result = false;

		if ($this->catalog_id > 0) {
			$catalog = Catalog::findById($this->catalog_id);
			if (!$catalog || $catalog->catalog_id == $old_catalog_id) {
				$query = PDO()->prepare('update catalogs set catalog_id = :catalog_id, catalog_name = :catalog_name where catalog_id = :cond_catalog_id');
				$result = $query->execute([
					'catalog_id' => $this->catalog_id,
					'catalog_name' => $this->catalog_name,
					'cond_catalog_id' => $old_catalog_id
				]);
			}else{
				$_SESSION['message'] = 'ID danh mục đã tồn tại. Vui lòng chọn ID khác.';
				
			}
		} else {
			$query = PDO()->prepare('insert into catalogs (catalog_name) values (:catalog_name)');
			$result = $query->execute([
				'catalog_name' => $this->catalog_name
			]);
			if ($result) {
				$this->catalog_id = PDO()->lastInsertId();
			}
		}

		return $result;
	}

	public function delete()
	{
		$query = PDO()->prepare('delete from catalogs where catalog_id = :catalog_id');
		return $query->execute(['catalog_id' => $this->catalog_id]);
	}

	public static function findById(int $catalog_id)
	{
		$query = PDO()->prepare('select * from catalogs where catalog_id = :catalog_id');
		$query->execute(['catalog_id' => $catalog_id]);
		if ($row = $query->fetch()) {
			$catalog = new Catalog();
			$catalog->fillFromDb($row);
			return $catalog;
		}
		return null;
	}

	protected function fillFromDb(array $row)
	{
		$this->catalog_id = $row['catalog_id'];
		$this->catalog_name = $row['catalog_name'];
		return $this;
	}

	public function fill(array $data)
	{
		$this->catalog_id = $data['catalog_id'] ?? 0;
		$this->catalog_name = $data['catalog_name'] ?? '';
		return $this;
	}
}
