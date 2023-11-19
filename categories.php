<?php
require_once('config.php');

if (!empty($_POST['name'])) {
    $name = htmlspecialchars($_POST['name']);
    $category_id = htmlspecialchars($_POST['category_id']);
    $connect = db_connect();
    $sql = "INSERT INTO `categories`( `name`) VALUES ('$name')";
    if (mysqli_query($connect, $sql)) {
        redirect_page('categories_ui.php?status=added');
    } else {
        echo 'err';
    }
} else {
    redirect_page('categories_ui.php?status=empty');
}
