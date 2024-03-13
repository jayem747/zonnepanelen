<?php
require_once("php/header.php");

$pdo = pdoObject("clearsky");
$sql = "SELECT * FROM producten";
$products = $pdo->prepare($sql);
$products->execute(array());

?>
<div class="main_content">
    <section class="divider_50px"><!-- divider --></section>
    <h1 class="blue_top_text">Pakketten</h1>
    <section class="divider_50px"><!-- divider --></section>
    <section id="products_grid">
        <?php foreach($products as $product) { 
            $base64_image = base64_encode($product["Foto"])
        ?>
        <section class="product_container">
            <section class="color_product_image">
                <img src="data:image/jpeg;base64,<?=$base64_image?>" class="product_image">
            </section>
            <h2><?=$product["Titel"]?></h2>
            <p><?=$product["Omschrijving"]?></p>
            <a href="product.php?productID=<?=$product["ProductID"]?>" class="view_product_button">bekijk product</a>
        </section>
        <?php } ?>
    </section>
    <section class="divider_150px"></section>
</div>
<?php
require_once("php/footer.php");
?>