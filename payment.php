<?php
require_once("php/header.php");
require_once("php/payment_function.php");
require_once("php/database_function.php");
payment();
redirect_user();

$pdo = pdoObjectLogin("clearsky");

$totaalPrijs = 0;

foreach($_SESSION["cart"] as $product) {
    $sql = "SELECT * FROM producten WHERE ProductID = :productID";
    $stm = $pdo->prepare($sql);
    $stm->bindParam(":productID", $product["ProductID"]);
    $stm->execute();
    $productDB = $stm->fetch();

    $totaalPrijs += ($productDB["Prijs"] * $product["amount"]);
}
?>

<div class="main_content">
    <section class="divider_50px"><!-- divider --></section>
    <div class="payment_page_container">
        <div class="left_grid">
            <h2>Totaalprijs: €<?=$totaalPrijs?></h2>
        </div>

        <div class="middle_grid">
            <button class="ideal_button">iDeal</button>
            <p class="pay_with_card">Betaal met kaart</p>
            <br>
            <form class="payment_form" method="post">
            <?php
                if (isset($_SESSION["MESSAGE"])) {
                    echo "<p class='admin_message'>" . $_SESSION["MESSAGE"] . "</p><br>";
                    unset($_SESSION["MESSAGE"]);
                }
            ?>
                <input type="hidden" id="fullName" name="fullName" value="<?php if (isset($_POST["fullName"])) { echo $_POST["fullName"]; } ?>">
                <input type="hidden" id="phoneNumber" name="phoneNumber" value="<?php if (isset($_POST["phoneNumber"])) { echo $_POST["phoneNumber"]; } ?>">
                <input type="hidden" id="afspraak" name="afspraak" value="<?php if (isset($_POST["afspraak"])) { echo $_POST["afspraak"]; } ?>">

                <input type="email" id="email" name="email" placeholder="Email" required>

                <label for="card_number">Kaartgegevens:</label>

                <input type="text" id="card_number" name="card_number" placeholder="Kaartnummer" required>

                <div class="card_details">
                    <div class="card_detail_item">
                        <input type="text" id="expiry_date" name="expiry_date" placeholder="MM/JJ" required>
                    </div>
                    <div class="card_detail_item">
                        <input type="number" id="cvc" name="cvc" placeholder="CVC" required>
                    </div>
                </div>

                <br>

                <input type="text" id="name_on_card" name="name_on_card" placeholder="Naam op kaart" required>

                <br> 

                <input type="text" id="address" name="address" placeholder="Adres" required>
                <input type="text" id="postcode" name="postcode" placeholder="Postcode" required>

                <br>
                <input type="submit" value="Betaal" name="payment_card" id="payment_card" class="credit_card_button">
            </form>
        </div>

        <div class="right_grid">
            <h3>Uw items:</h3>
            <ul>
                <?php
                    foreach($_SESSION["cart"] as $product) {
                        $sql = "SELECT * FROM producten WHERE ProductID = :productID";
                        $stm = $pdo->prepare($sql);
                        $stm->bindParam(":productID", $product["ProductID"]);
                        $stm->execute();
                        $productDB = $stm->fetch();
                    
                        echo "<li>" . $productDB["Titel"] . "<br>Aantal: " . $product["amount"] . " - Prijs: " . ($productDB["Prijs"] * $product["amount"]) . "</li>";
                    }
                ?>
            </ul>
        </div>
    </div>
    <section class="divider_50px"><!-- divider --></section>
</div>

<?php
require_once("php/footer.php");
?>