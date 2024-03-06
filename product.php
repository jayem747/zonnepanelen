<?php
require_once("php/header.php");


$productData = $_GET['productID'];
$dataFile = getProductId($productData);
?>

<div class="main_content">
    <?php
    foreach($dataFile as $product) {
        $base64_image = base64_encode($product["Foto"])
    ?>
    <section class="divider_50px"><!-- divider --></section>
    <h1 class="blue_top_text"><?=$product['Titel']?></h1>
    <section class="divider_50px"><!-- divider --></section>
    <section id="product_grid">
        <section class="product_page_container">
            <section class="">
                <img src="data:image/jpeg;base64, <?=$base64_image?>" class="product_image">
            </section>
            <br>
            <h2>Specificaties:</h2>
            <p><?=$product["Omschrijving"]?></p>
        </section>
        <section class="product_page_container">
            <h2>Prijs: €<?=$product["Prijs"]?></h2>
            <br><br>
            <form method="post" action="#">
                <input type="number" name="aantal" min="1" max="50">
                <br><br>
                <input type="submit" value="In winkelwagen">
            </form>
        </section>
    </section>
    <?php 
    }
    ?>
    <section class="divider_50px"><!-- divider --></section>
    <section class="horizontal_ad">
        advertentie
    </section>
</div>
<section class="divider_150px"><!-- divider --></section>

<?php
require_once("php/footer.php");
?>