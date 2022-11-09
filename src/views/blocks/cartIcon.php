<div class="text-right" style="position: fixed; right: 4%; bottom: 10%;">
    <p class="cart">
        <a class="btn btn-outline-pink fw-bold" href="/cart">
            <i class="fa-solid fa-cart-shopping"></i>
            <?php
            if (isset($_SESSION['cart']) && count($_SESSION['cart']) > 0) {
                echo '<span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">' . count($_SESSION['cart']) . '</span>';
            }
            ?>
        </a>
    </p>
</div>