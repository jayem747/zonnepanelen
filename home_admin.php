<?php
require_once("php/admin_header.php");
session_start();

$pdo = pdoObject("clearsky");
$sql = "SELECT * FROM producten";
$products = $pdo->prepare($sql);
$products->execute(array());
?>

<div class="main_content">
    <h1 class="blue_top_text">Bestaande producten</h1>
    <section class="divider_50px"><!-- divider --></section>

    <?php 
    if (isset($_SESSION["MESSAGE"])) {
        echo "<p class='admin_message'>" . $_SESSION["MESSAGE"] . "</p><br>";
        unset($_SESSION["MESSAGE"]);
    }
    ?>
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
                <p class="product_description"><?=$product["Omschrijving"]?></p>
                <div class="yellow_divider"></div>
                <table class="admin_price_and_stock_container">
                    <tr>
                        <th></th>
                        <th></th>
                    </tr>
                    <tr>
                        <td class="admin_product_price">Prijs:</td>
                        <td>€<?=$product["Prijs"]?></td>
                    </tr>
                    <tr>
                        <td class="admin_product_stock">Voorraad:</td>
                        <td><?=$product["Voorraad"]?></td>
                    </tr>
                </table>
                <section class="divider_50px"><!-- extra space --></section>
                <section class="edit_and_delete_bt_container">
                    <a href="edit_product.php?productID=<?=$product["ProductID"]?>" class="product_edit_bt">Bewerken</a>
                    <a href="delete_product.php?productID=<?=$product["ProductID"]?>" class="product_delete_bt">Verwijderen</a>
                </section>
                <section class="divider_50px"><!-- extra space --></section>
            </section>
        <?php
        }
        ?>
</div>
<section class="divider_150px"><!-- divider --></section>
<?php
require_once("php/footer.php");
?>