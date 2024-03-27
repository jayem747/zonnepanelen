<?php
require_once("php/header.php");
require_once("php/database_function.php");
redirect_user();
?>

<div class="main_content">
    <section class="divider_50px"><!-- divider --></section>
    <div class="payment_page_container">
        <div class="left_grid">
            
        </div>

        <script>
            const date = new Date();

            let day = date.getDate();
            let month = date.getMonth() + 1;
            let year = date.getFullYear();
        </script>
        

        <div class="middle_grid">
            <form class="payment_form" action="payment.php" method="post">
                <input type="text" id="fullName" name="fullName" placeholder="Volledige Naam" required>

                <br>

                <input type="text" id="phoneNumber" name="phoneNumber" placeholder="Telefoon Nummer" required>

                <br> 

                <input type="date" id="afspraak" name="afspraak" required>

                <br>
                <input type="submit" value="Verder" name="verder" id="verder" class="credit_card_button">
            </form>
        </div>

        <div class="right_grid">
            <h3>Uw items:</h3>
            <ul>
                <?php
                    $pdo = pdoObjectLogin("clearsky");

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