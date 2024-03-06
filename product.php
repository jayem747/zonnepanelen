<?php
require_once("php/header.php");
?>

<div class="main_content">
    <section class="divider_50px"><!-- divider --></section>
    <h1 class="blue_top_text">X</h1>
    <section class="divider_50px"><!-- divider --></section>
    <section id="product_grid">
        <section class="product_page_container">
            <section class="">
                <img src="img/solar_image.png" class="product_image">
            </section>
            <br>
            <h2>Specificaties:</h2>
            <p>XX</p>
        </section>
        <section class="product_page_container">
            <h2>Prijs: €XXX,XX</h2>
            <br><br>
            <form method="post" action="#">
                <input type="number" name="aantal" min="1" max="50">
                <br><br>
                <input type="submit" value="In winkelwagen">
            </form>
        </section>
    </section>
    <section class="divider_50px"><!-- divider --></section>
    <section class="horizontal_ad">
        advertentie
    </section>
</div>
<section class="divider_150px"><!-- divider --></section>

<?php
require_once("php/footer.php");
?>