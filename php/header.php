<?php
include("database_function.php");
session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Clearsky Solar</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link rel="icon" type="image/x-icon" href="img/favicon.ico">
        <link rel="stylesheet" href="css/style.css">
    </head>
    <header>
        <div id="header_top_layer">
            <section class="header_left_side">
                <a href="index.php"><img src="img/logo.png" alt="site_logo" class="site_logo"></a>
            </section>
            <?php if(isset($_SESSION["username"])) { ?>
                <section class="header_right_side">
                <?php if(isset($_SESSION["admin"]) && $_SESSION["admin"] == true) { ?>
                    <a href="admin.php">Admin</a>
                <?php } ?>
                <a href="php/logout.php">Logout</a>
                <a href="cart.php" class="shopping_cart"><i class="fa-solid fa-cart-shopping"></i></a>
            <?php } else { ?>
                <section class="header_right_side">
                <a href="login.php">Login</a>
                <a href="register.php">Registreer</a>
                <a href="cart.php" class="shopping_cart"><i class="fa-solid fa-cart-shopping"></i></a>
            </section>
            <?php } ?>
        </div>
        <div id="header_bot_layer">
            <a href="#">offerte</a>
            <a href="#">dashboard</a>
            <a href="#">contact</a>
        </div>
    </header>
    <body>
