<?php
require_once("php/admin_header.php");

$pdo = pdoObject("clearsky");
$sql = "SELECT * FROM facturen";
$facturen = $pdo->prepare($sql);
$facturen->execute(array());
?>

<div class="main_content">
    <h1 class="blue_top_text">Alle afspraken</h1>
    <section class="divider_50px"><!-- divider --></section>

    <?php 
    if (isset($_SESSION["MESSAGE"])) {
        echo "<p class='admin_message'>" . $_SESSION["MESSAGE"] . "</p><br>";
        unset($_SESSION["MESSAGE"]);
    }
    ?>
    <section id="products_grid">
        <?php
        foreach($facturen as $factuur) {
        ?>
            <section class="product_container">
                <br>
                <h2><?=$factuur["Naam"]?></h2>
                <p class="afspraak_description"><?=$factuur["Adres"]?> - <?=$factuur["Postcode"]?></p>
                <p class="afspraak_description">Telefoonnummer: <?=$factuur["Telefoonnummer"]?></p>
                <p class="afspraak_description">Datum: <?=$factuur["Datum"]?></p>
                <p class="afspraak_description">Email: <?=$factuur["Email"]?></p>
                <br>
                <?php 
                    $sql = "SELECT * FROM factuur_regel WHERE FactuurID = :factuurID";

                    $stm = $pdo->prepare($sql);
                    $stm->bindParam(":factuurID", $factuur["FactuurID"]);
                    $stm->execute();

                    $regels = $stm->fetchAll();
                    foreach ($regels as $regel) {
                        $sql = "SELECT * FROM producten WHERE ProductID = :productID";
                        $stm = $pdo->prepare($sql);
                        $stm->bindParam(":productID", $regel["ProductID"]);
                        $stm->execute();
                        $product = $stm->fetch();
                        echo "<p class='afspraak_description'>Product Naam: " . $product["Titel"] . "</p><p class='afspraak_description'>Aantal: " . $regel["Amount"] . " -  Prijs: " . ($product["Prijs"] * $regel["Amount"]) . "</p>";
                    }

                ?>
                <h6 class="afspraak_description">FactuurID: <?=$factuur["FactuurID"]?></h6>
                <section class="divider_50px"><!-- extra space --></section>
                <section class="edit_and_delete_bt_container">
                    <a href="delete_factuur.php?factuurID=<?=$factuur["FactuurID"]?>" class="product_delete_bt_afspraken">Verwijderen</a>
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