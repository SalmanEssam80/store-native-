<?php
require_once('config.php');
if (!empty($_POST['username']) && !empty($_POST['password'])) {
    $username = htmlspecialchars($_POST['username']);
    $email = '';
    $mobile = '';
    $password = htmlspecialchars($_POST['password']);
    if ($valid_email = filter_var(filter_var($username, FILTER_SANITIZE_EMAIL), FILTER_VALIDATE_EMAIL)) {
        $email = $valid_email;
    } elseif ($valid_mobile = filter_var($username, FILTER_VALIDATE_REGEXP, ['options' => EGYPT_FORMAT_NUMBER])) {
        $mobile = $valid_mobile;
    } else {
        redirect_page('login_ui.php?status=invalid');
    }
    // mobile or email
    $connect = db_connect();
    $sql = "SELECT `id`,`name`,`email`,`mobile`,`role` FROM `users` WHERE password = md5('$password') and (email = '$email' or mobile = '$mobile')";
    $result = mysqli_query($connect, $sql);
    if ($user = mysqli_fetch_assoc($result)) {
        //user exists
        if ($user['role'] == 'admin') {
            if (!empty($_POST['remember_me']) && $_POST['remember_me'] == 1) {
                setcookie('email', $user['email'], time() + 60 * 60 * 24 * 30 * 12);
                setcookie('mobile', $user['mobile'], time() + 60 * 60 * 24 * 30 * 12);
                setcookie('name', $user['name'], time() + 60 * 60 * 24 * 30 * 12);
                setcookie('role', $user['role'], time() + 60 * 60 * 24 * 30 * 12);
            }
            session_start();
            $_SESSION['user'] = $user;
            require 'mail.php';
            sendMail($user['email'], $user['name'], 'Login Verified', '<h3>' . 'Hello ' . $user['name'] . ' Some One Try To Login To Your Account At ' . date('Y-m-d H:i:s a') . '</h3>');
            redirect_page('main.php');
        } else {
            redirect_page('login_ui.php?status=not_auth');
        }
    } else {
        redirect_page('login_ui.php?status=not_found');
    }
} else {
    redirect_page('login_ui.php?status=empty');
}
