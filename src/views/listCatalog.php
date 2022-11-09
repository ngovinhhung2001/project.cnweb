<div class="container">
    <table class="table border w-75 mx-auto">
        <tr class="text-center">
            <td>ID</td>
            <td>Tên danh mục</td>
            <td>Thao tác</td>
        </tr class="text-center">
        <?php foreach ($catalogs as $catalog) : ?>
            <tr class="text-center">
                <td><?= $catalog->catalog_id ?></td>
                <td><?= $catalog->catalog_name ?></td>
                <td>
                    <a class="btn btn-outline-pink" href="/catalogs/delete/<?php echo $catalog->catalog_id ?>">Xóa</a>
                    <a class="btn btn-outline-pink" href="/catalogs/edit/<?php echo $catalog->catalog_id ?>">Sửa</a>
                </td>
            </tr>
        <?php endforeach ?>
    </table>
</div>