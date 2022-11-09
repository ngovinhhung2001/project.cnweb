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
			<h1 class="mb-3 h1 mt-11 fs-4r text-dark d-sm-block d-none"><strong>HK</strong> Milktea & Tea</h1>
			<h1 class="mb-3 h1 mt-11 fs-3r text-dark d-block d-sm-none"><strong>HK</strong> Milktea & Tea</h1>
			<p class="mt-3 mb-11">Thơm ngon trọn vị</p>
		</div>
		<div class="container">
			<h1 class="d-inline text-dark">Sản Phẩm</h1>
			<h1 class="d-inline text-dark-pink text-uppercase">Nổi Bật</h1>
			<div class="row mt-4 justify-content-around">
				<?php
				foreach ($products as $product) :
					if ($product->product_featured == 1) {
				?>
						<div class="col-12 col-sm-4 mb-5">
							<div class="card rounded-0 shadow">
								<a href="/products/detail/<?php echo $product->product_id ?>">
									<img class="productImg card-img-top " src="/uploads/<?php echo $product->product_img ?>">
								</a>
								<div class="card-body text-center">
									<p class="text-darker-pink fs-4 fw-bold"><?php echo $product->product_name ?></p>
									<p></p>
									<p class="fw-bold fs-5 text-danger"><?php echo currency_format($product->product_price, ' VNĐ') ?></p>
								</div>
							</div>
						</div>
				<?php
					}
				endforeach
				?>
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