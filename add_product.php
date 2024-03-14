<?php
require_once("php/admin_header.php");
require_once("php/admin_functions.php");

$pdo = pdoObject("clearsky");
$sql = "SELECT * FROM producten";
$products = $pdo->prepare($sql);
$products->execute(array());
?>
<div class="main_content">
    <h1 class="blue_top_text">Product toevoegen</h1>
    <section class="divider_50px"><!-- extra space --></section>
    <div class="two_sided_page">
        <section class="page_left_side">
            <form action="" method="post" enctype="multipart/form-data">
                <label for="name">Naam</label>
                <input type="text" name="naam">
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
                        <td><input type="number" name="voorraad"></td>
                        <td><input type="number" class="yellow_input"  step=0.01 name="prijs"></td>
                    </tr>
                </table>
                <section class="divider_25px"><!-- extra space --></section>
                <label for="specificatie">Specificaties</label>
                <input type="text" id="specificatie" name="specificaties">
                <section class="divider_25px"><!-- extra space --></section>
                <label for="omschrijving">Omschrijving</label>
                <textarea id="omschrijving" name="omschrijving" rows="4" cols="50"></textarea>
        </section>
        <section class="page_right_side">
            <p>Foto's</p>
            <img id="newProductImage" src="img/NoPicture.jpeg" class="form_img_product"><br>
                <br>
                <input type="file" id="newProduct_image" name="product_image" accept="image/*">
                <section class="divider_25px"><!-- extra space --></section>
                <section class="divider_25px"><!-- extra space --></section>
                <input type="submit" name="addProduct" value="product toevoegen" class="submit_dark_blue">
            </form>
        </section>
    </div>
</div>
<section class="divider_150px"><!-- extra space --></section>

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
$(document).ready(function(){
    // Handle file input change event for adding a new product
    $("#newProduct_image").change(function(){
        var input = this;
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                // Update the image source for adding a new product
                $("#newProductImage").attr("src", e.target.result);
            };
            reader.readAsDataURL(input.files[0]);
        }
    });
});
</script>

<?php
require_once("php/footer.php");
addProductAdmin();
?>