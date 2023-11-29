<?php
require_once('config.php');
require_once('User.php');
$user_id = $_POST['edit_user_id'];
$user = new User($_POST['name'], $_POST['email']);
$user->mobile = $_POST['mobile'];
$user->role = $_POST['role'];
if ($user->update($user_id)) {
    redirect_page('users_show.php?status=empty');
} else {
    redirect_page('users_show.php?status=updated');
}