<nav class="navbar navbar-expand-lg bg-pink">
    <div class="container">
        <a class="navbar-brand" href="/">
            <img src="/img/logo.png" alt="" width="60">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active text-dark-pink fw-bolder" aria-current="page" href="/">Trang Chủ</a>
                </li>

                <?php
                if (\App\SessionGuard::isUserLoggedIn()) :
                    $user = \App\SessionGuard::user();
                    if ($user->user_id == 1) :
                ?>
                        <li id="dropdown-admin" class="nav-item dropdown fw-bolder">
                            <a id="dropdown-toggle-admin" class="nav-link dropdown-toggle" href="/admin" aria-expanded="false">
                                Quản lý
                            </a>
                            <ul id="dropdown-menu-admin" class="dropdown-menu rounded">
                                <li><a class="dropdown-item text-dark-pink fw-bold" href="/catalogs/add">Danh mục</a></li>
                                <li><a class="dropdown-item text-dark-pink fw-bold" href="/products/add">Sản phẩm</a></li>
                                <li><a class="dropdown-item text-dark-pink fw-bold" href="/bills">Hóa Đơn</a></li>
                            </ul>
                        </li>
                <?php
                    endif;
                endif;
                ?>

                <li id="dropdown-catalog" class="nav-item dropdown fw-bolder">
                    <a id="dropdown-toggle-catalog" class="nav-link dropdown-toggle" href="/products" aria-expanded="false">
                        Sản Phẩm
                    </a>
                    <ul id="dropdown-menu-catalog" class="dropdown-menu rounded">
                        <?php foreach ($catalogs as $catalog) : ?>
                            <li><a class="dropdown-item text-dark-pink fw-bold" href="/products/<?php echo $catalog->catalog_id ?>"><?php echo $catalog->catalog_name ?></a></li>
                        <?php endforeach ?>
                    </ul>


                </li>

            </ul>
            <?php if (!\App\SessionGuard::isUserLoggedIn()) : ?>
                <a class="btn btn-outline-pink fw-bold rounded-pill px-3" href="/login">Đăng nhập</a>
            <?php else : ?>
                <div id="dropdown-user" class="nav-item dropdown fw-bolder">
                    <a id="dropdown-toggle-user" class="nav-link p-2" href="" aria-expanded="false">
                        <i class="fa-regular fa-user text-dark-pink fw-bold"></i>
                        <i class="text-dark-pink fw-bold ms-2 fst-normal"> <?= \App\SessionGuard::user()->user_name ?> </i>
                    </a>
                    <ul id="dropdown-menu-user" class="dropdown-menu rounded">
                        <li><a class="dropdown-item text-dark-pink fw-bold" href="/logout" onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">Đăng xuất</a></li>
                        <?php if (\App\SessionGuard::user()->user_id != 1) : ?>
                            <li><a class="dropdown-item text-dark-pink fw-bold" href="/users/bills">Hóa đơn</a></li>
                        <?php endif; ?>
                    </ul>
                    <form id="logout-form" action="/logout" method="POST" style="display: none;">
                    </form>
                </div>
            <?php endif ?>
        </div>
    </div>
</nav>