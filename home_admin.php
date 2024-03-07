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
                <div class="yellow_divider"></div>
                <p>Prijs: €<?=$product["Prijs"]?></p>
                <p>Voorraad: <?=$product["Voorraad"]?></p>
                <section>
                    <a href="edit_product.php?productID=<?=$product["ProductID"]?>" class="product_edit_bt">Bewerken</a>
                    <a href="delete_product.php?productID=<?=$product["ProductID"]?>" class="product_delete_bt">Verwijderen</a>
                </section>
            </section>
        <?php
        }
        ?>
</div>
<section class="divider_150px"><!-- divider --></section>
<?php
require_once("php/footer.php");
?>