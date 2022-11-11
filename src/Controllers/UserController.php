<?php

namespace App\Controllers;

use App\Models\User;
use App\Models\Product;
use App\Models\Bill;
use App\Models\BillDetail;
use App\Models\Catalog;

use App\SessionGuard as Guard;

class UserController
{
	public function showUserBillDetailPage($id){
		$bill = Bill::findById($id);
		$user = User::findById($bill->user_id);
		$data = [
			'error' => session_get_flash('error'),
			'bill' => $bill,
            'billsdetails' => BillDetail::findByBillId($id),
            'catalogs' => Catalog::all(),
            'products' => Product::all(),
			'user_bill' => $user,
		];

		render_view('/billDetail', $data);
    }

	public function showUserBillPage()
	{
		$user = Guard::user();
		$data = [
			'catalogs' => Catalog::all(),
			'bills' => Bill::findByUserId($user->user_id)
		];
		render_view('/userBill', $data);
	}

	public function showLoginPage()
	{
		$data = [
			'messages' => session_get_flash('messages'),
			'old' => $this->getSavedFormValues(),
			'errors' => session_get_flash('errors')
		];
		render_view('login', $data);
	}

	public function login()
	{
		$user_credentials = $this->filterUserCredentials($_POST);
		$user = User::findByEmail($user_credentials['email']);
		$errors = [];

		if (!$user) {
			// Người dùng không tồn tại...
			$errors['email'] = 'Sai email hoặc mật khẩu.';
		} else if (Guard::login($user, $user_credentials)) {
			// Đăng nhập thành công...
			redirect('/home');
		} else {
			// Sai mật khẩu...
			$errors['password'] = 'Sai email hoặc mật khẩu.';
		}

		// Đăng nhập không thành công: lưu giá trị trong form, trừ password
		$this->saveFormValues($_POST, ['password']);
		render_view('/login', ['errors' => $errors]);
	}

	public function logout()
	{
		Guard::logout();
		redirect('/home');
	}

	protected function filterUserCredentials(array $data)
	{
		return [
			'email' => filter_var($data['email'], FILTER_VALIDATE_EMAIL),
			'password' => $data['password'] ?? null
		];
	}

	// Lưu các giá trị của form được cho trong $data vào $_SESSION 
	protected function saveFormValues(array $data, array $except = [])
	{
		$form = [];
		foreach ($data as $key => $value) {
			if (!in_array($key, $except, true)) {
				$form[$key] = $value;
			}
		}
		$_SESSION['form'] = $form;
	}

	protected function getSavedFormValues()
	{
		return session_get_flash('form', []);
	}

	public function showRegisterPage()
	{
		$data = [
			'old' => $this->getSavedFormValues(),
			'errors' => session_get_flash('errors')
		];

		render_view('/register', $data);
	}

	public function register()
	{
		$this->saveFormValues($_POST, ['password', 'password_confirmation']);

		$data = $this->filterUserData($_POST);
		$model_errors = User::validate($data);
		if (empty($model_errors)) {
			// Dữ liệu hợp lệ...
			$this->createUser($data);

			$messages = ['success' => 'User has been created successfully.'];
			render_view('/login', ['messages' => $messages]);
		}

		// Dữ liệu không hợp lệ...
		render_view('/register', ['errors' => $model_errors]);
	}

	protected function filterUserData(array $data)
	{
		return [
			'name' => $data['name'] ?? null,
			'email' => filter_var($data['email'], FILTER_VALIDATE_EMAIL),
			'password' => $data['password'] ?? null,
			'password_confirmation' => $data['password_confirmation'] ?? null
		];
	}

	protected function createUser($data)
	{
		$user = new User([
			'user_name' => $data['name'],
			'user_email' => $data['email'],
			'user_password' => password_hash($data['password'], PASSWORD_DEFAULT)
		]);
		$user->save();
	}
}
