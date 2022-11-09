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
                <h1 class="text-dark-pink text-uppercase"><?= $product->product_name ?></h1>
            </div>
        </div>
        <div style="background-color: #5f5f5f13;">
            <div class="container ">
                <div class="row pt-3 mb-3 ">
                    <nav class="col-12" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item fw-bold active"><a class="text-reset" href="/home" style="text-decoration: none;">Trang chủ</a></li>
                            <li class="breadcrumb-item fw-bold text-dark-pink" aria-current="page">Sản phẩm</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row justify-content-around mt-5">
                <div class="col-sm-4 fw-bold">
                    <a href="/products/detail/<?= $product->product_id ?>">
                        <img class="productImg card-img-top" src="/uploads/<?= $product->product_img ?>">
                    </a>
                </div>
                <div class="col-sm-7 mt-5">
                    <form action="/cart/add/<?= $product->product_id ?>" method="POST">
                        <p class="card-title text-uppercase h2"><?= $product->product_name ?></p>
                        <p class="card-text mt-3"><?= $product->product_info ?></p>
                        <p class="fw-bold text-danger h4">Giá: <?= currency_format($product->product_price, ' VNĐ')  ?></p>
                        <input class="text-center" max="10" min="1" name="product_amount" type="number" value="1" style="width: 40px; height: 25px;">
                        <p><input class="btn btn-outline-pink fw-bold rounded-0 px-3 mt-3" type="submit"  value="Thêm vào giỏ"></p>
                    </form>
                </div>
            </div>
            <div class="row justify-content-between mt-5">
                <hr />
                <p class="card-text mb-5 mt-4 h2 text-center"><?= $product->product_info ?></p>
                <hr />
            </div>
        </div>
    </main>
    <footer>
        <?php
        require_once 'blocks/footer.php';
        require_once 'blocks/cartIcon.php';
        ?>
    </footer>
    <?php
    require_once 'partials/js.php';
    ?>
</body>

</html>