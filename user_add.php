<?php
require_once('config.php');
require_once('User.php');
$user = new User($_POST['name'], $_POST['email']);
$user->setpassword($_POST['password']);
$user->mobile = $_POST['mobile'];
$user->role = $_POST['role'];
if ($user->create()) {
    redirect_page('users_show.php?status=added');
} else {
    redirect_page('users_show.php?info=emptyy');
}

$delete_user_id = $_GET['delete_user_id'];
if (User::destroy($delete_user_id)) {
    redirect_page('users_show.php?status=deleted');
} else {
    echo "err";
}