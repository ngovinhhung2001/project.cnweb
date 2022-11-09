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
        <div class="bg-image p-5 text-center shadow-1-strong " style="background-image: url('/img/background.png'); background-repeat: no-repeat; background-size: 1712px;">
            <p class="fw-bold fs-3r text-dark d-sm-block d-none p-5">Trang Admin</p>
            <p class="fw-bold fs-2-5r text-dark d-sm-none d-block p-5">Trang Admin</p>
        </div>
        <div class="container">
            <div class="row mt-5 justify-content-around text-center">
                <div class="col-sm-3">
                    <a class="btn btn-outline-pink fs-3 mb-3" href="/catalogs/add">Quản lý danh mục</a>
                </div>
                <div class="col-sm-3">
                    <a class="btn btn-outline-pink fs-3" href="/products/add">Quản lý sản phẩm</a>
                </div>
                <div class="col-sm-3">
                    <a class="btn btn-outline-pink fs-3" href="/bills">Quản lý hóa đơn</a>
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