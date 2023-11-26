<?php
require('config.php');
if (!empty($_GET['lang'])) {
    setcookie('lang', $_GET['lang'], time() + 60 * 60 * 24 * 30);
}
redirect_page($_SERVER['HTTP_REFERER']);