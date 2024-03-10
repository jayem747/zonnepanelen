<?php
require_once("php/admin_header.php");

$pdo = pdoObject("clearsky");
$sql = "SELECT * FROM producten";
$products = $pdo->prepare($sql);
$products->execute(array());
?>
<div class="main_content">
    <h1 class="blue_top_text">Bewerken product</h1>
    <section class="divider_50px"><!-- extra space --></section>
    <div class="two_sided_page">
        <section class="page_left_side">
            <form>
                <label for="name">Naam</label>
                <input type="text" name="name">
                <section class="divider_25px"><!-- extra space --></section>
                <table>
                    <tr>
                        <th></th>
                        <th></th>
                    </tr>
                    <tr>
                        <td><label for="stock">Voorraad</label></td>
                        <td><label for="price">Prijs</label></td>
                    </tr>
                    <tr class="close_input">
                        <td><input type="number" name="stock"></td>
                        <td><input type="number" class="yellow_input"  step=0.01 name="Prijs"></td>
                    </tr>
                </table>
                <section class="divider_25px"><!-- extra space --></section>
                <label for="short_desc">Korte omschrijving</label>
                <input type="text" name="short_desc">
                <section class="divider_25px"><!-- extra space --></section>
                <label for="whole_desc">volledige omschrijving</label>
                <textarea name="whole_desc" rows="4" cols="50"></textarea>
        </section>
        <section class="page_right_side">
            <p>Foto's</p>
                <img src="img/solar_image.png" class="form_img_product">
                <section class="divider_25px"><!-- extra space --></section>
                <table class="double_buttons">
                    <tr>
                        <th></th>
                        <th></th>
                    </tr>
                    <tr>
                        <td><input type="button" class="blue_button_left" value="Toevoegen"/></td>
                        <td><input type="button" class="yellow_button_right" value="verwijderen"/></td>
                    </tr>
                </table>
                <section class="divider_25px"><!-- extra space --></section>
                <input type="submit" value="Wijzigingen bevestigen" class="submit_dark_blue">
            </form>
        </section>
    </div>
</div>
<section class="divider_150px"><!-- extra space --></section>
<?php
require_once("php/footer.php");
?>