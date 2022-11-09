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
                <h1 class="d-inline text-dark me-2"><?= $title_start ?></h1>
                <h1 class="d-inline text-dark-pink text-uppercase"><?= $title_end ?></h1>
            </div>
        </div>
        <div style="background-color: #5f5f5f13;">
            <div class="container ">
                <div class="row pt-3 mb-3 ">
                    <nav class="col-12" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item fw-bold active"><a class=" text-reset" href="home.html" style="text-decoration: none;">Trang chủ</a></li>
                            <li class="breadcrumb-item fw-bold text-dark-pink" aria-current="page">Sản phẩm</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-sm-2 fw-bold" style="border-right: dashed 1px #5f5f5f48;">
                    <div class="sidebar sticky-sm-top pt-4" style="top: 70px;">
                        <div class="row">
                            <p class="col-12 col-sm-12 h4 fw-bold mb-4 text-dark-pink text-uppercase">Sản Phẩm</p>
                            <a class="col col-sm-12 text-decoration-none text-muted mb-2" href="/products">TẤT CẢ</a>
                            <a class="col col-sm-12 text-decoration-none text-muted mb-2" href="/products/featured">NỔI BẬT</a>
                            <?php foreach ($catalogs as $catalog) : ?>
                                <a class="col col-sm-12 text-decoration-none text-muted mb-2 text-uppercase" href="/products/<?= $catalog->catalog_id ?>"><?= $catalog->catalog_name ?></a>
                            <?php
                            endforeach
                            ?>
                        </div>
                    </div>
                </div>
                <div class="col-sm-10">
                    <div class="row mt-4">
                        <?php foreach ($products as $product) : ?>
                            <div class="col-12 col-sm-4 mb-5">
                                <div class="card rounded-0 shadow">
                                    <a href="/products/detail/<?= $product->product_id ?>">
                                        <img class="productImg card-img-top" src="/uploads/<?= $product->product_img ?>">
                                    </a>
                                    <div class="card-body text-center">
                                        <h5 class="card-title"><?= $product->product_name ?></h5>
                                        <p class="card-text"><?= $product->product_info ?></p>
                                        <h6 class="fw-bold fs-5 text-danger"><?= currency_format($product->product_price, ' VNĐ') ?></h6>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach ?>
                    </div>
                </div>
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