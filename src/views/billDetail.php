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
        <div class="bg-image p-5 text-center shadow-1-strong mb-5" style="background-image: url('/img/background.png'); background-repeat: no-repeat; background-size: 1712px;">
            <div class="col-12 mt-4 mb-4">
                <h1 class="d-inline text-dark me-2">Chi tiết</h1>
                <h1 class="d-inline text-dark-pink text-uppercase">Hóa Đơn</h1>
            </div>
        </div>
        <div class="container">
            <div class="row justify-content-around">
                <div class="col-md-9 col-lg-5">
                    <div class="card p-0">
                        <div class="card-body">
                            <div class="row ">
                                <?php 
                                $user_current = \App\SessionGuard::user();
                                if ( $user_current->user_id == 1) { ?>
                                    <form action="/bills" method="GET">
                                        <input type="submit" class="btn-close" aria-label="Close" value=""></button>
                                    </form>
                                <?php } else { ?>
                                    <form action="/users/bills" method="GET">
                                        <input type="submit" class="btn-close" aria-label="Close" value=""></button>
                                    </form>
                                <?php } ?>

                            </div>
                            <div class="row">
                                <p class="text-center text-uppercase text-dark-pink fw-bold fs-3">Hóa đơn</p>

                            </div>
                            <hr>
                            
                            <p><strong>Tên: </strong> <?= $user_bill->user_name ?></p>
                            <p><strong>SĐT:</strong> <?= $bill->phone_number ?></p>
                            <p><strong>Địa chỉ:</strong> <?= $bill->delivery_address ?></p>
                            <hr>
                            <?php
                            if ($bill) {
                                $tongtienhang = 0;
                                $tongsoluong = 0;
                                foreach ($billsdetails as $billsdetail) :
                                    foreach ($products as $product) :
                                        if ($product->product_id == $billsdetail->product_id) {
                            ?>
                                            <div class="row mb-4">
                                                <div class="col-3 col-sm-2">
                                                    <img class="w-100" src="/uploads/<?= $product->product_img ?>">
                                                </div>
                                                <div class="col">
                                                    <div class="row">
                                                        <p class="m-0"><?= $product->product_name ?></p>
                                                    </div>
                                                    <div class="row">
                                                        <p class="text-muted m-0 fs-0-75r" class="m-0"><?= currency_format($product->product_price, ' VNĐ')  ?></p>
                                                    </div>
                                                    <div class="row">
                                                        <p class="">x <?= $billsdetail->product_amount ?></p>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <p class="text-end fw-bold"><?= currency_format($billsdetail->product_amount * $product->product_price, ' VNĐ') ?></p>
                                                </div>
                                            </div>
                                <?php
                                            $tongtienhang += $billsdetail->product_amount * $product->product_price;
                                            $tongsoluong += $billsdetail->product_amount;
                                        }
                                    endforeach;
                                endforeach;
                                if ($tongsoluong >= 4) {
                                    $tiengiaohang = 0;
                                } else {
                                    $tiengiaohang = 15000;
                                }
                                ?>
                                <div class="row">
                                    <p class="text-end">Tiền hàng: <strong><?= currency_format($tongtienhang, ' VNĐ') ?></strong></p>
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
                                        <?= currency_format($tiengiaohang + $tongtienhang, ' VNĐ'); ?>
                                    </strong>
                                </p>



                            <?php
                            }
                            ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <footer>
        <?php
        require_once 'blocks/footer.php';
        ?>
    </footer>
    <?php
    require_once 'partials/js.php';
    ?>
</body>

</html>