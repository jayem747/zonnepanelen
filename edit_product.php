<?php
require_once("php/admin_header.php");
require_once("php/admin_functions.php");

editProductAdmin();

$pdo = pdoObject("clearsky");
$id = $_GET["productID"];
$sql = "SELECT * FROM producten WHERE ProductID = :id";
$products = $pdo->prepare($sql);
$products->bindParam(':id', $id);
$products->execute();

$product = $products->fetch(PDO::FETCH_ASSOC);
?>
<div class="main_content">
    <h1 class="blue_top_text">Bewerken product</h1>
    <?php
        if (isset($_SESSION["MESSAGE"])) {
            echo "<p class='admin_message'>" . $_SESSION["MESSAGE"] . "</p><br>";
            unset($_SESSION["MESSAGE"]);
        }
    ?>
    <section class="divider_50px"><!-- extra space --></section>
    <div class="two_sided_page">
        <section class="page_left_side">
            <form action="" method="post" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?= $_GET["productID"]?>">
                <label for="naam">Naam</label>
                <input type="text" id="naam" name="naam" value="<?php echo $product["Titel"] ?>">
                <section class="divider_25px"><!-- extra space --></section>
                <table>
                    <tr>
                        <th></th>
                        <th></th>
                    </tr>
                    <tr>
                        <td><label for="voorraad">Voorraad</label></td>
                        <td><label for="prijs">Prijs</label></td>
                    </tr>
                    <tr class="close_input">
                        <td><input type="number" id="voorraad" name="voorraad" value="<?php echo $product["Voorraad"] ?>"></td>
                        <td><input type="number" id="prijs" class="yellow_input" step=0.01 name="prijs" value="<?php echo $product["Prijs"] ?>"></td>
                    </tr>
                </table>
                <section class="divider_25px"><!-- extra space --></section>
                <label for="specificatie">Specificaties</label>
                <input type="text" id="specificatie" name="specificaties" value="<?php echo $product["Specificaties"] ?>">
                <section class="divider_25px"><!-- extra space --></section>
                <label for="omschrijving">Omschrijving</label>
                <textarea id="omschrijving" name="omschrijving" rows="4" cols="50"><?php echo $product["Omschrijving"] ?></textarea>
        </section>
        <section class="page_right_side">
            <p>Foto's</p>
                <?php $base64_image = base64_encode($product["Foto"]);
                    $image_src = "data:image/jpeg;base64," . $base64_image;
                ?>
                <img id="uploadedImage" src="<?= $image_src ?>" class="form_img_product"><br>
                <input type="file" id="product_image" name="product_image" accept="image/png"><p>Max >1mb</p>
                <section class="divider_25px"><!-- extra space --></section>
                <section class="divider_25px"><!-- extra space --></section>
                <input type="submit" name="editProduct" value="Wijzigingen bevestigen" class="submit_dark_blue">
            </form>
        </section>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
$(document).ready(function(){
    // Handle file input change event
    $("#product_image").change(function(){
        // Read the selected file
        var input = this;
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                // Update the image source
                $("#uploadedImage").attr("src", e.target.result);
            };
            reader.readAsDataURL(input.files[0]);
        }
    });
});
</script>

<section class="divider_150px"><!-- extra space --></section>

<?php
require_once("php/footer.php");
?>