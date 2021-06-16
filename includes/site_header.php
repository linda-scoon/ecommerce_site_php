<?php require('includes/application_top.php'); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="/css/styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <title><?= $page_title ?></title>
</head>

<body class="lead">
    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-light p-4">
            <div class="container">
                <h1><a class="logo-outer" href="index.php">Nail<span class="logo-inner">Varnish</span></a></h1>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#nav-menu">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="nav-menu">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item ">
                            <a class="nav-link bi-house mx-1" href="index.php" title="home">
                                <span class="ms-1">Home</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link bi-basket mx-1" href="page_basket.php" title="basket">
                                <span class="ms-1">Basket</span>
                            </a>
                        </li>
                        <?php
                        //including links to appear only when logged in
                        if (!isset($_SESSION['user'])) {
                        ?>
                            <li class="nav-item">
                                <a class="nav-link bi-person-fill mx-1" href="page_login.php" title="login">
                                    <span class="ms-1">Login</span>
                                </a>
                            </li>
                        <?php
                        } else {
                        ?>
                            <li class="nav-item">
                                <a class="nav-link bi-person-fill mx-1" href="page_profile.php" title="profile">
                                    <span class="ms-1">Profile</span>
                                </a>
                            </li>
                            <?php
                            //only allowing admins to view this link
                            if ($_SESSION['user']['role'] == 'admin') { ?>
                                <li class="nav-item">
                                    <a class="nav-link mx-1" href="page_admin.php" title="admin">
                                        <span class="ms-1">Admin</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link mx-1" href="page_encryption.php" title="encryption">
                                        <span class="ms-1">Encryption</span>
                                    </a>
                                </li>
                            <?php
                            } ?>
                            <li class="nav-item">
                                <a class="nav-link mx-1" href="page_logout.php" title="logout">
                                    <span class="ms-1">Logout</span>
                                </a>
                            </li>
                        <?php
                        }
                        ?>
                    </ul>
                </div>
            </div>
        </nav>
        <form action="" method="get" class="d-flex search my-2">
            <input type="search" placeholder="Search" class="form-control me-1">
            <button class="btn btn-lg btn-outline-danger bi-search" type="submit"></button>
        </form>
    </header>
    <div class="container wrapper">