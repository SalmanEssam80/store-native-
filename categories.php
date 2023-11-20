<?php
require_once('config.php');
$connect = db_connect();

if(!empty($_GET['category_id'])){
    $category_id = $_GET['category_id'];
    $sql_delete = "DELETE FROM `categories` WHERE id = $category_id";
    if (mysqli_query($connect,$sql_delete)){
        redirect_page('categories_ui.php?status=deleted');
    }
}

// insert item
if (!empty($_POST['name'])) {
    $name = htmlspecialchars($_POST['name']);
    $category_id = htmlspecialchars($_POST['category_id']);
    $sql = "INSERT INTO `categories`(`name`, `category_id`) VALUES ('$name',$category_id)";
    if (mysqli_query($connect, $sql)) {
        redirect_page('categories_ui.php?status=added');
    } else {
        echo 'err';
    }
} else {
    redirect_page('categories_ui.php?status=empty');
}
