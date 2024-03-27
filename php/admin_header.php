<?php
include("database_function.php");
include("login_functions.php");
if (session_status() === PHP_SESSION_NONE) session_start();
redirect_no_admin();
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
            <section class="header_left_side admin_left_side">
                <a href="home_admin.php"><img src="img/logo.png" alt="site_logo" class="site_logo"></a>
            </section>
            <h3 class="admin_header_text">Welkom admin</h3>
            <section class="header_right_side admin_right_side">
            <a href="add_product.php">Product toevoegen</a>
                <a href="index.php">Naar homepage</a>
            </section>
        </div>
        <div id="header_bot_layer">
            <a href="home_admin.php">Alle producten</a>
            <a href="admin_afspraken.php">Afspraken</a>
        </div>
    </header>
    <body>