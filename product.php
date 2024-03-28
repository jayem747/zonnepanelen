<?php
require_once("php/header.php");
shopping_cart();


$productData = $_GET['productID'];
$dataFile = getProductId($productData);
?>

<div class="main_content">
    <?php
    foreach($dataFile as $product) {
        $base64_image = base64_encode($product["Foto"]);
    ?>
    <section class="divider_50px"><!-- divider --></section>
    <h1 class="blue_top_text"><?=$product['Titel']?></h1>
    <section class="divider_50px"><!-- divider --></section>

    <?php
        if (isset($_SESSION["MESSAGE"])) {
            echo "<p class='admin_message'>" . $_SESSION["MESSAGE"] . "</p><br>";
            unset($_SESSION["MESSAGE"]);
        }
    ?>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>?productID=<?=$product['ProductID']?>">
        <section id="product_grid">
            <input type="hidden" name="ProductID" value="<?=$product['ProductID']?>">
            <section class="product_page_container">
                <section class="">
                    <img src="data:image/jpeg;base64, <?=$base64_image?>" class="product_image" width="720px">
                </section>
                <br>
                <h2>Specificaties:</h2>
                <p><?=$product["Omschrijving"]?></p>
            </section>
            <section class="product_page_container">
                <h2>Prijs: €<?=$product["Prijs"]?></h2>
                <br><br>
                <form class="product_form" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                    <input type="number" name="amount" min="1" max="50" placeholder="Aantal" value="1">
                    <br><br>
                    <input type="hidden" name="action" value="setInCart">
                    <input type="submit" name="setInCart" value="In winkelwagen">
                </form>
            </section>
        </section>
    </form>
    <?php 
    }
    ?>
    <section class="divider_50px"><!-- divider --></section>
    <section class="horizontal_ad">
        <!-- advertentie -->
    </section>
</div>
<section class="divider_150px"><!-- divider --></section>

<?php
require_once("php/footer.php");
?>