<?php
require_once('config.php');
$connect = db_connect();

// delete category
if (!empty($_GET['category_id'])) {
    $category_id = $_GET['category_id'];
    $sql_delete = "DELETE FROM `categories` WHERE id = $category_id";
    if (mysqli_query($connect, $sql_delete)) {
        redirect_page('categories_ui.php?status=deleted');
    }
}

// insert & update category
if (!empty($_POST['name'])) {
    $name = htmlspecialchars($_POST['name']);
    $category_id = htmlspecialchars($_POST['category_id']);
    if (empty($_POST['edit_category_id'])) {
        $sql = "INSERT INTO `categories`(`name`, `category_id`) VALUES ('$name',$category_id)";
    } else {
        $sql = "UPDATE `categories` SET `name`='$name',`category_id`=$category_id WHERE id = " . $_POST['edit_category_id'];
    }
    if (mysqli_query($connect, $sql)) {
        empty($_POST['edit_category_id']) ? $status = 'added' : $status = 'updated';
        redirect_page('categories_ui.php?status=' . $status);
    } else {
        echo 'err';
    }
} else {
    redirect_page('categories_ui.php?status=empty');
}
