<?php
require_once("php/header.php");

$pdo = pdoObject("clearsky");
$sql = "SELECT * FROM producten LIMIT 3";
$products = $pdo->prepare($sql);
$products->execute(array());
?>

<div class="main_content">
    <div class="welcome">
    <img src="img/solar-energy.jpg">
        <div class="overlay-text">
            <h1>Welkom Bij</br>Clearsky Solar</h1>
            <p>uw partner in duurzame energieoplossingen</p>
        </div>
    </div>
    <section class="divider_50px"><!-- space between ad and welcome section --></section>
    <?php
        if (isset($_SESSION["succes"])) {
            echo "<p class='succes_message'>" . $_SESSION["succes"] . "</p><br>";
            unset($_SESSION["succes"]);
        }
    ?>
    <section class="horizontal_ad">
        <!-- advertentie -->
    </section>
    <section class="divider_50px"><!-- space between ad and blue text --></section>
    <h1 class="blue_top_text">Onze pakketten</h1>
    <section class="divider_50px"><!-- space between blue text and products --></section>

    <!-- container of all the products -->
    <section id="products_grid">
        <?php
        foreach($products as $product) {
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
        <?php
        }
        ?>
        <section><!-- empty section for spacing of button --></section>
        <a href="pakketten.php" class="products_page_link">Zie meer</a>
    </section>

    <section class="divider_50px"><!-- space between products and text --></section>
    <p class="solar_intro_text">Bij SolarTech geloven we in de kracht van de zon en streven we ernaar om groene energie toegankelijk te maken voor iedereen. Onze hoogwaardige solarpakketten bieden niet alleen een milieuvriendelijke manier om uw energieverbruik te verminderen, maar ook om te besparen op uw energierekening op de lange termijn. Of u nu op zoek bent naar zonne-energiesystemen voor uw huis, bedrijf of gemeenschap, ons deskundige team staat klaar om u te begeleiden bij elke stap van het proces Bij Clearsky Solar geloven we in de kracht van de zon en streven we ernaar om groene energie toegankelijk te maken voor iedereen. Onze hoogwaardige solarpakketten bieden niet alleen een milieuvriendelijke manier om uw energieverbruik te verminderen, maar ook om te besparen op uw energierekening op de lange termijn. Of u nu op zoek bent naar zonne-energiesystemen voor uw huis, bedrijf of gemeenschap, ons deskundige team staat klaar om u te begeleiden bij elke stap van het proces.</p>
</div>
<?php
require_once("php/footer.php");
?>