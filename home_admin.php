<?php
require_once("php/admin_header.php");

$pdo = pdoObject("clearsky");
$sql = "SELECT * FROM producten";
$products = $pdo->prepare($sql);
$products->execute(array());
?>

<div class="main_content">
    <h1 class="blue_top_text">Onze pakketten</h1>
    <section class="divider_50px"><!-- divider --></section>
    <section id="products_grid">
        <?php
        foreach($products as $product) {
            $base64_image = base64_encode($product["Foto"])
        ?>
            <section class="product_container">
                <section class="color_product_image">
                    <img src="data:image/jpeg;base64, <?=$base64_image?>" class="product_image">
                </section>
                <h2><?=$product["Titel"]?></h2>
                <p><?=$product["Omschrijving"]?></p>
                <p>Prijs: €<?=$product["Prijs"]?></p>
                <p>Voorraad: <?=$product["Voorraad"]?></p>
                <section>
                    <a href="edit_product.php?productID=<?=$product["ProductID"]?>" class="view_product_button">Bewerken</a>
                    <a href="delete_product.php?productID=<?=$product["ProductID"]?>">Verwijderen</a>
                </section>
            </section>
        <?php
        }
        ?>
</div>
</body>
</html>