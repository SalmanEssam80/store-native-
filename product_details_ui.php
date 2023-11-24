<?php
$active = 'products';
include_once('header.php');
require_once('config.php');
if (!empty($_GET['product_id'])) {
    $product_id = $_GET['product_id'];
    $connect = db_connect();
    $select_query = "select  * from products where  id =" . $product_id;
    $result = mysqli_query($connect, $select_query);
    $product = mysqli_fetch_assoc($result);
    $category_id = $product['category_id'];
    $select_query_category = "select  * from categories where  id = " . $category_id;
    $result_2 = mysqli_query($connect, $select_query_category);
    $category = mysqli_fetch_assoc($result_2);
    $porduct_images_qry = "SELECT * FROM `product_images` where product_id = " . $product_id;
    $result_3 = mysqli_query($connect, $porduct_images_qry);
}
?>

<main class="flex-shrink-0">
    <div class="container bg-light">
        <h3>Full Details Of Product</h3>
        <div class="card">
            <div class="row g-0">
                <div class="col-7">
                    <div class="row">
                        <?php while ($image = mysqli_fetch_assoc($result_3)) { ?>
                            <img src="<?= $image['url'] ?>" class="img-thumbnail border-1 col-6" alt="..">
                        <?php } ?>
                    </div>
                </div>
                <div class="col-5">
                    <div class="card-body">
                        <h2 class="card-title mb-5">Name: <?= $product['name'] ?></h2>
                        <h2 class="card-title mb-5">Category: <?= $category['name'] ?></h2>
                        <h2 class="card-title mb-5">Price: <?= $product['unit_price'] ?> per <?= $product['unit_type'] ?></h2>
                        <h2 class="card-title mb-5">Created At : <?= date_format(date_create($product['created_at']), 'F j, Y, g:i a') ?></h2>
                        <h2 class="card-title mb-5">Description: <?= $product['comment'] ?></h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<?php
include_once('footer.php');
?>