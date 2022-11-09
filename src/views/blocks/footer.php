<div class="container-fluid bg-pink">
    <div class="container ">
        <div class="row mt-5 pt-4 pb-34">
            <div class="col-sm-6 mt-5">
                <div class="row text-dark-pink justify-content-around">
                    <div class="col-6 col-sm-5 mb-5">
                        <p class="fw-bold mb-3 text-uppercase">Về chúng tôi</p>
                        <a class="mb-1 text-decoration-none text-reset">Khởi nguồn thương hiệu</a>
                        <br>
                        <a class="mb-1 text-decoration-none text-reset">Trách nhiệm cộng đồng</a>
                    </div>
                    <div class="col-6 col-sm-4">
                        <p class="fw-bold mb-3 text-uppercase">Sản phẩm</p>
                        <?php foreach ($catalogs as $catalog) : ?>
                            <a class="mb-1 text-decoration-none text-reset" href="/products/<?=$catalog->catalog_id?>">HK <?=$catalog->catalog_name?></a>
                            <br>
                        <?php endforeach; ?>
                    </div>
                    <div class="col-12 col-sm-3">
                        <p class="fw-bold mb-3 text-uppercase">Tin tức</p>
                        <a class="mb-1 text-decoration-none text-reset">Khuyến mãi</a>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 mt-5 mb-4">
                <div class="row text-dark-pink justify-content-around">
                    <div class="col-12 col-sm-6" style="border-left: solid 1px #5f5f5f48;">
                        <p class="fw-bold mb-3 text-uppercase">HK Milktea & Tea</p>
                        <p class="mb-1 "><i class="fa-solid fa-map-location-dot"></i> Địa chỉ: Khu II, đường 3/2, P.Xuân Khánh, Q.Ninh Kiều, TP.Cần Thơ</p>
                        <p class="mb-1 "><i class="fa-solid fa-envelope"></i> dhct@ctu.edu.vn </p>
                        <p class="mb-1 "><i class="fa-solid fa-phone"></i> 0292 3832 663</p>
                    </div>
                    <div class="col-12 col-sm-6  d-none d-sm-block">
                        <p class="d-sm-none"></p>
                        <p class="fw-bold mb-3">FOUNDER</p>
                        <p class="mb-1">Ngô Vĩnh Hưng</p>
                    </div>
                </div>
            </div>
        </div>
        <hr />
        <div class="row">
            <p class="fw-bold text-dark-pink"><i class="fa-regular fa-copyright" style="font-size: 13px;"></i> Copyright 2022 HK Milktea & Tea</p>
        </div>
    </div>
</div>