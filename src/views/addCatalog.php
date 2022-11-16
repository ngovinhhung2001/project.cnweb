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
        <?php require_once 'blocks/header.php'; ?>
    </header>
    <main>
        <div class="bg-image p-5 text-center shadow-1-strong" style="background-image: url('/img/background.png'); background-repeat: no-repeat; background-size: 1712px;">
            <div class="col-12 mt-4 mb-4">
                <h1 class="d-inline text-dark me-2">Thêm</h1>
                <h1 class="d-inline text-dark-pink text-uppercase">Danh mục</h1>
            </div>
        </div>
        <div class="container mt-3">
            <table class="table border w-75 mx-auto">
                <form method="POST" action="/catalogs/add">
                    <tr>
                        <td class="text-end">Tên danh mục</td>
                        <td><input type="text" name="catalog_name" class="w-50" required></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td><input type="submit" value="Thêm danh mục"></td>
                    </tr>
                </form>
            </table>
        </div>
        <?php require_once 'listCatalog.php'; ?>
    </main>
    <footer>
        <?php require_once 'blocks/footer.php'; ?>
    </footer>
    <?php  require_once 'partials/js.php'; ?>
</body>

</html>