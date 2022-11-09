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
        <div class="bg-image p-5 text-center shadow-1-strong" style="background-image: url('/img/background.png'); background-repeat: no-repeat; background-size: 1712px;">
            <div class="col-12 mt-4 mb-4">
                <h1 class="d-inline text-dark me-2">Thêm</h1>
                <h1 class="d-inline text-dark-pink text-uppercase">Sản phẩm</h1>
            </div>
        </div>
        <div class="container mt-3">
            <table class="table border w-75 mx-auto">
                <form method="POST" action="/products/add" enctype="multipart/form-data">
                    <tr>
                        <td class="text-end">Tên sản phẩm</td>
                        <td><input type="text" name="product_name" class="w-50" required></td>
                    </tr>
                    <tr>
                        <td class="text-end">Giá</td>
                        <td><input type="text" name="product_price" class="w-50" required></td>
                    </tr>
                    <tr>
                        <td class="text-end">Hình ảnh</td>
                        <td><input type="file" name="product_img" class="w-50" required></td>
                    </tr>
                    <tr>
                        <td class="text-end">Thông tin</td>
                        <td><textarea name="product_info" cols="30" rows="5"></textarea></td>
                    </tr>
                    <tr>
                        <td class="text-end">Danh mục sản phẩm</td>
                        <td>
                            <select name="catalog_id">
                                <?php  foreach ($catalogs as $catalog) : ?>
                                    <option value="<?php echo $catalog->catalog_id ?>"> <?php echo $catalog->catalog_name ?></option>
                                <?php endforeach ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-end">Trạng thái</td>
                        <td>
                            <select name="product_status">
                                <option value="1">Hiện</option>
                                <option value="0">Ẩn</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-end">Sản phẩm nổi bật</td>
                        <td>
                            <select name="product_featured">
                                <option value="1">Có</option>
                                <option selected value="0">Không</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td><input type="submit" value="Thêm sản phẩm"></td>
                    </tr>
                </form>
            </table>
        </div>
        <?php
        require_once 'listProduct.php';
        ?>
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