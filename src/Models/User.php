<?php

namespace App\Models;

class User
{
	public int $user_id = -1;
	public string $user_name = '';
	public string $user_email = '';
	public string $user_password = '';

	public function __construct(array $data = [])
	{
		$this->fill($data);
	}

	public static function validate(array $data)
	{
		$errors = [];

		$check_user = User::findByEmail($data['email']) != null ? 1 : 0;

		if (!$data['email']) {
			$errors['email'] = 'Email không tồn tại';
		} elseif ($check_user) {
			$errors['email'] = 'Email đã được sử dụng';
		}

		if (strlen($data['password']) < 6) {
			$errors['password'] = 'Mật khẩu phải ít nhất 6 kí tự';
		} elseif ($data['password'] != $data['password_confirmation']) {
			$errors['password'] = 'Mật khẩu nhập lại không trùng khớp';
		}

		return $errors;
	}

	public static function all(): array
	{
		$users = [];

		$query = PDO()->prepare('select * from users');
		$query->execute();
		while ($row = $query->fetch()) {
			$user = new User();
			$user->fillFromDb($row);
			$users[] = $user;
		}

		return $users;
	}

	public function save()
	{
		$result = false;

		if ($this->user_id >= 0) {
			$query = PDO()->prepare('update users set user_name = :user_name, user_email = :user_email, user_password = :user_password
            where user_id = :user_id');
			$result = $query->execute([
				'user_id' => $this->user_id,
				'user_name' => $this->user_name,
				'user_email' => $this->user_email,
				'user_password' => $this->user_password,
			]);
		} else {
			$query = PDO()->prepare('insert into users (user_name, user_email, user_password) values (:user_name, :user_email, :user_password)');
			$result = $query->execute([
				'user_name' => $this->user_name,
				'user_email' => $this->user_email,
				'user_password' => $this->user_password,
			]);
			if ($result) {
				$this->catalog_id = PDO()->lastInsertId();
			}
		}

		return $result;
	}

	public function delete()
	{
		$query = PDO()->prepare('delete from users where user_id = :user_id');
		return $query->execute(['user_id' => $this->user_id]);
	}

	public static function findById(int $user_id)
	{
		$query = PDO()->prepare('select * from users where user_id = :user_id');
		$query->execute(['user_id' => $user_id]);
		if ($row = $query->fetch()) {
			$user = new User();
			$user->fillFromDb($row);
			return $user;
		}
		return null;
	}

	public static function findByEmail(string $user_email)
	{
		$query = PDO()->prepare('select * from users where user_email = :user_email');
		$query->execute(['user_email' => $user_email]);
		if ($row = $query->fetch()) {
			$user = new User();
			$user->fillFromDb($row);
			return $user;
		}
		return null;
	}

	protected function fillFromDb(array $row)
	{
		$this->user_id = $row['user_id'];
		$this->user_name = $row['user_name'];
		$this->user_email = $row['user_email'];
		$this->user_password = $row['user_password'];
		return $this;
	}

	public function fill(array $data)
	{
		$this->user_name = $data['user_name'] ?? '';
		$this->user_email = $data['user_email'] ?? '';
		$this->user_password = $data['user_password'] ?? '';
		return $this;
	}
}
