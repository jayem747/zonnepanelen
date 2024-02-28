<?php
require_once("php/header.php");
?>

<div id="main_content">
    <div class="welcome">
        <h1>Welkom Bij</br>Clearsky Solar</h1>
        <p>uw partner in duurzame energieoplossingen</p>
    </div>
    <section class="divider_50px"><!-- space between ad and welcome section --></section>
    <section class="horizontal_ad">
        advertentie
    </section>
    <section class="divider_50px"><!-- space between ad and blue text --></section>
    <h1 class="blue_top_text">Onze pakketten</h1>
    <section class="divider_50px"><!-- space between blue text and products --></section>

    <!-- container of all the products -->
    <section id="products_grid">
        <section class="product_container">
            <img src="img/solar_image.png" class="product_image">
            <h2>basispakket</h2>
            <p>Ontdek ons instappakket: 4 zonnepanelen, omvormer en installatie. Bespaar direct op uw energierekening!</p>
            <a href="product.php?productID=#" class="view_product_button">bekijk product</a>
        </section>
        <section class="product_container">
            <img src="img/solar_image.png" class="product_image">
            <h2>basispakket</h2>
            <p>Ontdek ons instappakket: 4 zonnepanelen, omvormer en installatie. Bespaar direct op uw energierekening!</p>
            <a href="product.php?productID=#" class="view_product_button">bekijk product</a>
        </section>
        <section class="product_container">
            <img src="img/solar_image.png" class="product_image">
            <h2>basispakket</h2>
            <p>Ontdek ons instappakket: 4 zonnepanelen, omvormer en installatie. Bespaar direct op uw energierekening!</p>
            <a href="product.php?productID=#" class="view_product_button">bekijk product</a>
        </section>
    </section>
</div>
<?php
require_once("php/footer.php");
?>