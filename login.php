<?php
require_once('config.php');
if (!empty($_POST['username']) && !empty($_POST['password'])) {
    $username = htmlspecialchars($_POST['username']);
    $email = '';
    $mobile = '';
    $password = htmlspecialchars($_POST['password']);
    if ($valid_email = filter_var(filter_var($username, FILTER_SANITIZE_EMAIL), FILTER_VALIDATE_EMAIL)) {
        $email = $valid_email;
    } elseif ($valid_mobile = filter_var($username, FILTER_VALIDATE_REGEXP, ['options' => ['regexp' => '/^(\+20)\d{10}$/']])) {
        $mobile = $valid_mobile;
    } else {
        redirect_page('login_ui.php?status=invalid');
    }
    // mobile or email
    $connect = db_connect();
    $sql = "SELECT `id`,`name`,`email`,`mobile`,`role` FROM `users` WHERE password = md5('$password') and (email = '$email' or mobile = '$mobile')";
} else {
    redirect_page('login_ui.php?status=empty');
}
