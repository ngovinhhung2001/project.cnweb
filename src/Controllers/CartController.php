<?php

namespace App\Controllers;

use App\Models\Product;
use App\Models\Catalog;
use App\Models\Bill;
use App\Models\BillDetail;

class CartController
{
    public function showCartPage()
    {
        render_view('cart', [
            'catalogs' => Catalog::all()
        ]);
    }

    public function create($id)
    {
        $product = Product::findById($id);
        $cart_product = array(
            'product_id' => $product->product_id, 'product_name' => $product->product_name, 'product_amount' => $_POST['product_amount'],
            'product_price' => $product->product_price, 'product_img' => $product->product_img,
        );
        if ($product) {
            if (isset($_SESSION['cart'])) {
                $found = false;
                for ($count = 0; $count < count($_SESSION['cart']); $count++) {
                    if ($_SESSION['cart'][$count]['product_id'] == $id) {
                        $found = true;
                        $_SESSION['cart'][$count]['product_amount'] += $_POST['product_amount'];
                    }
                }
                if ($found == false) {
                    $_SESSION['cart'][] = $cart_product;
                }

                $_SESSION['message'] = 'Thêm sản phẩm vào giỏ hàng thành công';
                redirect('/cart');
            } else {
                $_SESSION['cart'][0] = $cart_product;

                $_SESSION['message'] = 'Thêm sản phẩm vào giỏ hàng thành công';
                redirect('/cart');
            }
            
            $_SESSION['message'] = 'Thêm sản phẩm vào giỏ hàng thành công';
            redirect('/cart');
        }
        redirect('/cart');
    }

    public function update($id)
    {
        if (isset($_POST['edit_cart'])) {
            for ($count = 0; $count < count($_SESSION['cart']); $count++) {
                if ($_SESSION['cart'][$count]['product_id'] == $id) {
                    $_SESSION['cart'][$count]['product_amount'] = $_POST['product_amount'];
                }
            }
        }
        if (isset($_POST['minus'])) {
            for ($count = 0; $count < count($_SESSION['cart']); $count++) {
                if ($_SESSION['cart'][$count]['product_id'] == $id) {
                    if ($_SESSION['cart'][$count]['product_amount'] > 1) {
                        $_SESSION['cart'][$count]['product_amount']--;
                    }
                }
            }
        }
        if (isset($_POST['plus'])) {
            for ($count = 0; $count < count($_SESSION['cart']); $count++) {
                if ($_SESSION['cart'][$count]['product_id'] == $id) {
                    $_SESSION['cart'][$count]['product_amount']++;
                }
            }
        }
        redirect('/cart');
    }
    
    public function updateProductAmount($id, $product_amount){
        for ($count = 0; $count < count($_SESSION['cart']); $count++) {
            if ($_SESSION['cart'][$count]['product_id'] == $id) {
                $_SESSION['cart'][$count]['product_amount'] = $product_amount;
            }
        }
        redirect('/cart');
    }

    public function delete($id)
    {
        for ($count = 0; $count < count($_SESSION['cart']); $count++) {
            if ($_SESSION['cart'][$count]['product_id'] == $id) {
                unset($_SESSION['cart'][$count]);
                $_SESSION['cart'] = array_values($_SESSION['cart']);
            }
        }
        redirect('/cart');
    }

    public function pay()
    {
        $bill = new Bill();
        if(\App\SessionGuard::isUserLoggedIn()){
            if ($bill->fill($_POST)->save() ) {
                $bill= Bill::findByUserIdAndDate($_POST['user_id'], $_POST['bill_created_at']);
                for ($count = 0; $count < count($_SESSION['cart']); $count++) {
                    $billdetail = new BillDetail();
                    if ($billdetail->fill($bill->bill_id, $_SESSION['cart'][$count])->save()){
                        // unset($_SESSION['cart']);
                        $_SESSION['message'] = 'Đã thanh toán thành công';
                    }
                }
                unset($_SESSION['cart']);
                redirect('/cart');
            }
        }else{
            $_SESSION['message'] = 'Vui lòng đăng nhập để có thể thanh toán';
        }
        
        redirect('/cart');
    }
}
