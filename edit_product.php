<?php
require_once("php/admin_header.php");

$pdo = pdoObject("clearsky");
$sql = "SELECT * FROM producten";
$products = $pdo->prepare($sql);
$products->execute(array());
?>
<div class="main_content two_sided_page">
    <section class="page_left_side">
        <form>
            <label for="name">Naam</label>
            <input type="text" name="name">
            <table>
                <tr>
                    <th></th>
                    <th></th>
                </tr>
                <tr>
                    <td><label for="stock">Voorraad</label></td>
                    <td><label for="price">Prijs</label></td>
                </tr>
                <tr>
                    <td><input type="number" name="stock"></td>
                    <td><input type="float" name="Prijs"></td>
                </tr>
            </table>
            <label for="short_desc">Korte omschrijving</label>
            <input type="text" name="short_desc">
            <label for="whole_desc">volledige omschrijving</label>
            <textarea name="whole_desc" rows="4" cols="50"></textarea>
    </section>
    <section class="page_right_side">
        <p>Foto's</p>
            <img src="img/solar_image.png">
            <section class="input_next">
                <input type="button" value="Bewerken"/>
                <input type="button" value="verwijderen"/>
            </section>
            <input type="submit" value="Wijzigingen bevestigen">
        </form>
    </section>
</div>

<?php
require_once("php/footer.php");
?>