<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    require_once 'partials/setting.php';
    require_once 'partials/css.php';
    ?>
</head>

<body>
    <header class="sticky-top">
        <?php
        require_once 'blocks/header.php';
        ?>
    </header>
    <main>
        <div class="bg-image p-5 text-center shadow-1-strong" style="background-image: url('/img/background-product.png'); background-repeat: no-repeat; background-size: 1712px;">
            <div class="col-12 mt-4 mb-4">
                <h1 class="d-inline text-dark me-2 text-uppercase">Giỏ</h1>
                <h1 class="d-inline text-dark-pink text-uppercase">Hàng</h1>
            </div>
        </div>
        <br>
        <div class="container">
            <div class="row justify-content-around">
                <div class="col-md-9 col-lg-6 col-xxl-5">
                    <div class="card p-0">
                        <div class="card-body">
                            <div class="row mt-2">
                                <p class="text-center text-uppercase text-dark-pink fw-bold fs-3">Hóa đơn</p>
                            </div>

                            <?php
                            $tongsoluong = 0;
                            if (isset($_SESSION['cart'])) {
                                for ($i = 0; $i < count($_SESSION['cart']); $i++) {
                                    $tongsoluong += $_SESSION['cart'][$i]['product_amount'];
                                }
                            }
                            if (isset($_SESSION['cart']) && $tongsoluong > 0) {
                                $tongtienhang = 0;
                                $tongsoluong = 0;
                            ?>
                                <hr>
                                <table class="w-100">
                                    <tr>
                                        <th class="col-md-2"><label for="phone_number">SĐT: </label></th>
                                        <td class="col-md-10"><input type="number" id="phone_number" name="phone_number" placeholder="Nhập số điện thoại" form="order" required></td>
                                    </tr>
                                    <tr>
                                        <th><label for="delivery_address">Địa chỉ: </label></th>
                                        <td><input type="text" id="delivery_address" name="delivery_address" placeholder="Nhập địa chỉ giao hàng" style="width: 100%;" form="order" required></input>
                                    </tr>
                                </table>
                                <hr>
                                <?php
                                for ($i = 0; $i < count($_SESSION['cart']); $i++) {
                                ?>
                                    <div class="row mb-4">
                                        <div class="col-3 col-sm-2">
                                            <img class="w-100" src="/uploads/<?php echo $_SESSION['cart'][$i]['product_img'] ?>">
                                        </div>
                                        <div class="col">
                                            <div class="row">
                                                <p class="m-0"><?php echo $_SESSION['cart'][$i]['product_name'] ?></p>
                                            </div>
                                            <div class="row">
                                                <p class="text-muted m-0 fs-0-75r" class="m-0"><?php echo currency_format($_SESSION['cart'][$i]['product_price'], ' VNĐ')  ?></p>
                                            </div>
                                            <div class="row">
                                                <div class="col-12 col-sm-10 ">
                                                    <div class="row">
                                                        <form action="/cart/edit/<?php echo ($_SESSION['cart'][$i]['product_id']) ?>" method="POST">
                                                            <input class="d-none " type="submit" name="edit_cart">
                                                            <input class="text-center" type="submit" name="minus" value="-" style="width: 30px">
                                                            <input class="text-center p-0 number-input" min="1" name="product_amount" type="number" value="<?php echo $_SESSION['cart'][$i]['product_amount'] ?>" style="width: 40px; height: 30px;" onchange="updateCart(<?= $_SESSION['cart'][$i]['product_id'] ?>, this)">
                                                            <input class="text-center" type="submit" name="plus" value="+" style="width: 30px">
                                                        </form>
                                                    </div>
                                                </div>
                                                <div class="col-10 col-sm-2">
                                                    <form action="/cart/delete/<?php echo ($_SESSION['cart'][$i]['product_id']) ?>" method="POST">
                                                        <input type="submit" value="Xóa">
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm">
                                            <p class="text-end fw-bold"><?php echo currency_format($_SESSION['cart'][$i]['product_amount'] * $_SESSION['cart'][$i]['product_price'], ' VNĐ') ?></p>
                                        </div>
                                    </div>
                                <?php
                                    $tongtienhang += $_SESSION['cart'][$i]['product_amount'] * $_SESSION['cart'][$i]['product_price'];
                                    $tongsoluong += $_SESSION['cart'][$i]['product_amount'];
                                }
                                if ($tongsoluong >= 4) {
                                    $tiengiaohang = 0;
                                } else {
                                    $tiengiaohang = 15000;
                                }
                                ?>
                                <div class="row">
                                    <p class="text-end">Tiền hàng: <strong><?php echo currency_format($tongtienhang, ' VNĐ') ?></strong></p>
                                    <p class="text-end">Tiền ship:
                                        <strong>
                                            <?php
                                            if ($tiengiaohang == 0) {
                                                echo 'Miễn phí';
                                            } else {
                                                echo currency_format($tiengiaohang, ' VNĐ');
                                            }
                                            ?>
                                        </strong>
                                    </p>
                                </div>
                                <hr />
                                <p class="text-end">Tổng tiền đơn hàng:
                                    <strong>
                                        <?php
                                        echo currency_format($tiengiaohang + $tongtienhang, ' VNĐ');
                                        ?>
                                    </strong>
                                </p>
                                <hr />
                                <form id="order" action="/cart/order" method="POST">
                                    <?php for ($i = 0; $i < count($_SESSION['cart']); $i++) { ?>
                                        <input class="d-none" type="number" name="product_<?= $_SESSION['cart'][$i]['product_id'] ?>" value="<?= $_SESSION['cart'][$i]['product_amount'] ?>">
                                    <?php } ?>
                                    <input class="d-none" type="text" name="bill_created_at" value="<?= date("Y-m-d h:i:s") ?>">
                                    <?php if (\App\SessionGuard::isUserLoggedIn()) { ?>
                                        <input class="d-none" type="text" name="user_id" value="<?= \App\SessionGuard::user()->user_id ?>">
                                    <?php } ?>
                                    <div class="row my-4">
                                        <input type="submit" class="btn btn-outline-pink w-75 mx-auto d-block text-uppercase fw-bold" value="Đặt hàng"></input>
                                    </div>
                                </form>

                            <?php } else { ?>
                                <hr>
                                <p class="text-center text-dark-pink fw-bold">Hiện tại giỏ hàng trống.</p>
                                <p class="text-center text-dark-pink fw-bold">Bạn hãy chọn mua sản phẩm rồi quay lại nhé !</p>
                            <?php } ?>

                        </div>
                    </div>
                </div>
            </div>
            <?php

            ?>
        </div>
        <br>
    </main>
    <footer>
        <?php
        if (isset($_SESSION['message'])) {
            require_once 'blocks/modal.php';
        }
        require_once 'blocks/footer.php';
        ?>
    </footer>
    <?php
    require_once 'partials/js.php';
    ?>
</body>

</html>