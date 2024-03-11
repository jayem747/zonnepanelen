<?php
require_once("php/header.php");

$pdo = pdoObject("clearsky");
$sql = "SELECT * FROM producten";
$products = $pdo->prepare($sql);
$products->execute(array());
?>

<div class="main_content">
    <section class="divider_50px"><!-- extra space --></section>
    <div class="two_sided_page">
        <section class="page_left_side">
            <section class="product_in_cart_container">
                <img src="img/solar_image.png" class="cart_product_img">
                <section>
                    <h2>Lorem pakket</h2>
                    <p>aantal: x</p>
                    <p>totaal: €x.xx</p>
                </section>
            </section>
            <section class="product_in_cart_container">
                <img src="img/solar_image.png" class="cart_product_img">
                <section>
                    <h2>Lorem pakket</h2>
                    <p>aantal: x</p>
                    <p>totaal: €x.xx</p>
                </section>
            </section>
            <section class="divider_50px"><!-- extra space --></section>
            <a href="payment.php" class="cart_buttons">Betaal</a>
            <a href="#" class="cart_buttons">Afspraak</a>
        </section>
        <section class="page_right_side">
            <section class="vertical_ad">
                <!-- ad -->
            </section>
        </section>
    </div>
    <section class="divider_150px"><!-- extra space --></section>
</div>
<?php
require_once("php/footer.php");
?>