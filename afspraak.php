<?php
require_once("php/header.php");
?>

<div class="main_content">
    <section class="divider_50px"><!-- divider --></section>
    <div class="payment_page_container">
        <div class="left_grid">
            <h2>Totaalprijs: €XXX</h2>
        </div>

        <div class="middle_grid">
            <form class="payment_form" action="payment.php">
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
                <li>Item 1</li>
                <li>Item 2</li>
            </ul>
        </div>
    </div>
    <section class="divider_50px"><!-- divider --></section>
</div>

<?php
require_once("php/footer.php");
?>