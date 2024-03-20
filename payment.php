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
            <button class="ideal_button">iDeal</button>
            <p class="pay_with_card">Betaal met kaart</p>
            <br>
            <form class="payment_form">
                <input type="email" id="email" name="email" placeholder="Email" required>

                <label for="card_number">Kaartgegevens:</label>

                <input type="text" id="card_number" name="card_number" placeholder="Kaartnummer" required>

                <div class="card_details">
                    <div class="card_detail_item">
                        <input type="text" id="expiry_date" name="expiry_date" placeholder="MM/JJ" required>
                    </div>
                    <div class="card_detail_item">
                        <input type="text" id="cvc" name="cvc" placeholder="CVC" required>
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