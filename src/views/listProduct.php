<div class="container">
    <table class="table border w-75 mx-auto">
        <tr class="text-center">
            <td>ID</td>
            <td>Tên sản phẩm</td>
            <td>Giá</td>
            <td>Danh mục</td>
            <td>Hình ảnh</td>
            <td>Thông tin</td>
            <td>Trạng thái</td>
            <td>Nổi bật</td>
            <td>Thao tác</td>
        </tr class="text-center">
        <?php foreach ($products as $product) : ?>
            <tr class="text-center">
                <td><?php echo $product->product_id ?></td>
                <td><?php echo $product->product_name ?></td>
                <td><?php echo $product->product_price ?></td>
                <td>
                    <?php
                    foreach ($catalogs as $catalog) :
                        if ($product->catalog_id == $catalog->catalog_id) {
                            echo $catalog->catalog_name;
                        }
                    endforeach
                    ?>
                </td>
                <td><img src="/uploads/<?php echo $product->product_img ?>" alt="" width="50px"></td>
                <td><?php echo $product->product_info ?></td>
                <td>
                    <?php
                    if ($product->product_status == 1) {
                        echo 'Hiện';
                    } else {
                        echo 'Ẩn';
                    }
                    ?>
                </td>
                <td>
                    <?php
                    if ($product->product_featured == 1) {
                        echo 'Có';
                    } else {
                        echo 'Không';
                    }
                    ?>
                </td>
                <td>
                    <a class="btn btn-outline-pink mb-1" href="/products/delete/<?php echo $product->product_id ?>">Xóa</a>
                    <a class="btn btn-outline-pink" href="/products/edit/<?php echo $product->product_id ?>">Sửa</a>
                </td>
            </tr>
        <?php endforeach ?>

    </table>
</div>