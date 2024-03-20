<?php
require_once("php/header.php");

$pdo = pdoObject("clearsky");
$sql = "SELECT * FROM producten";
$products = $pdo->prepare($sql);
$products->execute(array());

plus_and_minus_items();
?>

<div class="main_content">
    <?php var_dump($_SESSION);?>
    <section class="divider_50px"><!-- extra space --></section>
    <div class="two_sided_page">
        <section class="page_left_side">
            <?php
            if(isset($_SESSION['cart']) ) {
                print_shopping_cart();
            }
            else {
                print("Uw winkelwagen is leeg");
            }
            ?>
        </section>
        <section class="page_right_side">
            <section class="vertical_ad">
                <!-- ad -->
            </section>
        </section>
    </div>
    <section class="divider_150px"><!-- extra space --></section>
</div>
<?php
require_once("php/footer.php");
?>