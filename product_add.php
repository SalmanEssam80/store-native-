<?php
require_once('config.php');
echo "<pre>";
var_dump($_FILES['images']);
echo "</pre>";
// Add new Product
if (!(empty($_POST['name']) && empty($_POST['category_id']) && empty($_POST['unit']) && empty($_POST['unit_price']))) {
    $name = trim($_POST['name']);
    $category_id = filter_var($_POST['category_id'], FILTER_SANITIZE_NUMBER_INT);
    $unit = (empty($_POST['unit']) ? 'null' : $_POST['unit']);
    $unit_price = (empty($_POST['unit_price']) ? 'null' : $_POST['unit_price']);
    $comment = (empty($_POST['comment']) ? 'null' : $_POST['comment']);
    $connect = db_connect();
    $sql_insert = "INSERT INTO `products`(`name`, `unit_price`, `unit_type`, `comment`, `category_id`) VALUES ('$name',$unit_price,'$unit','$comment',$category_id)";
    $result = mysqli_query($connect, $sql_insert);
    $product_id = mysqli_insert_id($connect);
    if (!empty($_FILES['images'])) {
        $i = 1;
        foreach ($_FILES['images']['name'] as $key => $name) {
            $file_name = "product_images/" . date('Ymdhis') . '_' . $i++ . "_" . $name;
            move_uploaded_file($_FILES['images']['tmp_name'][$key], $file_name);
            $product_image_qry = "INSERT INTO `product_images`(`url`, `product_id`) VALUES ('$file_name','$product_id')";
            $product_image_qry_result = mysqli_query($connect, $product_image_qry);
        }
    }
    if ($result) {
        redirect_page('product_details_ui.php?product_id=' . $product_id);
    } else {
        redirect_page('product_add_ui.php?info=empty');
    }
}

//Delete Product
if (!empty($_GET['delete_product_id'])) {
    $delete_product_id = $_GET['delete_product_id'];
    $connect = db_connect();
    $sql_delete = "DELETE FROM `products` WHERE id = $delete_product_id";
    $data_result = mysqli_query($connect, "select * from `products` WHERE id = $delete_product_id");
    $porduct_images_qry = "SELECT * FROM `product_images` where product_id = $delete_product_id";
    $result_images_qry = mysqli_query($connect, $porduct_images_qry);
    while ($image = mysqli_fetch_assoc($result_images_qry)) {
        unlink($image['url']);
    }
    $result_delete_image = mysqli_query($connect, "delete from product_images where product_id = $delete_product_id");
    $result = mysqli_query($connect, $sql_delete);
    if (mysqli_error($connect) == "") {
        redirect_page('products_show.php?success=deleted');
    } else {
        redirect_page('products_show.php?err=' . mysqli_errno($connect));
    }
    mysqli_close($connect);
}
