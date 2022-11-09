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
                <h1 class="d-inline text-dark me-2">Danh sách</h1>
                <h1 class="d-inline text-dark-pink text-uppercase">Hóa Đơn</h1>
            </div>
        </div>
        <div class="container">
            <table class="table border w-75 mx-auto">
                <tr class="text-center">
                    <td>ID</td>
                    <td>Tên khách hàng</td>
                    <td>Ngày xuất hóa đơn</td>
                    <td>Tác vụ</td>
                </tr class="text-center">
                <?php
                foreach ($bills as $bill) :
                    foreach ($users as $user) :
                        if ($user->user_id == $bill->user_id) {
                ?>
                            <tr class="text-center">
                                <td><?= $bill->bill_id ?></td>
                                <td><?= $user->user_name ?></td>
                                <td><?= $bill->bill_created_at ?></td>
                                <td>
                                    <a class="btn btn-outline-pink" href="/bills/<?php echo $bill->bill_id ?>">Chi tiết hóa đơn</a>
                                </td>
                            </tr>
                <?php
                        }
                    endforeach;
                endforeach;
                ?>
            </table>
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