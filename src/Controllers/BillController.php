<?php

namespace App\Controllers;

use App\Models\Bill;
use App\Models\BillDetail;
use App\Models\Catalog;
use App\Models\Product;
use App\Models\User;

use App\SessionGuard as Guard;

class BillController{

    public function showBillPage(){
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
			'users' => User::all(),
			'bills' => Bill::all(),
            'catalogs' => Catalog::all()
		];

		render_view('/bill', $data);
    }

    public function showBillDetailPage($id){
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
			'bill' => Bill::findById($id),
            'billsdetails' => BillDetail::findByBillId($id),
            'catalogs' => Catalog::all(),
            'products' => Product::all()
		];

		render_view('/billDetail', $data);
    }


}