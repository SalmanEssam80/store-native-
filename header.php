<?php
session_start();
require_once('config.php');
if (empty($_SESSION['user'])) {
    if (!empty($_COOKIE['email']) && !empty($_COOKIE['mobile']) && !empty($_COOKIE['name']) && !empty($_COOKIE['role'])) {
        $_SESSION['user']['email'] = $_COOKIE['email'];
        $_SESSION['user']['mobile'] = $_COOKIE['mobile'];
        $_SESSION['user']['name'] = $_COOKIE['name'];
        $_SESSION['user']['role'] = $_COOKIE['role'];
    } else {
        redirect_page('login_ui.php?status=login_first');
    }
}
require_once('lang_en.php');
?>
<!DOCTYPE html>
<html lang="<?= $lang['lang'] ?>" dir="<?= $lang['dir'] ?>">

<head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }

        main>.container {
            padding: 60px 15px 0;
        }
    </style>
</head>

<body class="d-flex flex-column h-100">
    <header>
        <!-- Fixed navbar -->
        <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
            <div class="container-fluid">
                <a class="navbar-brand" href="main.php"><?= $lang['Store'] ?></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <ul class="navbar-nav me-auto mb-2 mb-md-0">
                        <li class="nav-item">
                            <a class="nav-link <?php if ($active == 'home')  echo 'active' ?>" aria-current="page" href="main.php"><?= $lang['Home'] ?></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php if ($active == 'categories')  echo 'active' ?>" href="categories_ui.php"><?= $lang['Categories'] ?></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php if ($active == 'products')  echo 'active' ?>" href="products_show.php"><?= $lang['Products'] ?></a>
                        </li>
                    </ul>
                    <div class="d-flex">
                        <p class="fw-bold text-white m-2"><?= $lang['Welcome'] ?> <?= $_SESSION['user']['name'] ?> </p>
                        <a href="logout_process.php" role="button" class="btn btn-secondary"><?= $lang['Logout'] ?></a>
                    </div>
                    <form class="d-flex">
                        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" />
                        <button class="btn btn-outline-success" type="submit">
                            Search
                        </button>
                    </form>
                </div>
            </div>
        </nav>
    </header>