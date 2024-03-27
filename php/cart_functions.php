<?php
function pdoObjectCart($dbname) {
    // Make a pdo connection

    $servername = "localhost";
    $user = "root";
    $pass = "";
    
    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $user, $pass);
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch(PDOException $e) {
        echo $sql . "<br>" . $e->getMessage();
    }
    return($conn);
}

function check_if_item_is_in_cart() {
    //function to check if the size and id are inside the session

    $isNewItem = true;

    // add the amount to the product with the same id
    if (isset($_SESSION['KlantID'])) {
        foreach ($_SESSION['cart'] as &$item) {
            if ($item["ProductID"] == $_POST['ProductID']) {
                $item['amount'] += intval($_POST['amount']);
                $isNewItem = false;
                break;
            }
        }

        // add the product to the cart
        if ($isNewItem && isset($_POST['ProductID'])) {
            array_push($_SESSION["cart"], [ "ProductID" => $_POST['ProductID'], "amount" => intval($_POST["amount"]) ]);
            $_POST['ProductID'] = null;
            $_POST['amount'] = null;
            $isNewItem = false;
            var_dump($_SESSION['cart']);
        }
    }
    else {
        header('location: login.php');
    }
}


function shopping_cart() {

    //When the add to cart button is clicked, the product will be added to the cart
    $pdo = pdoObjectCart("clearsky");
    if (isset($_POST["setInCart"]) && $_POST["action"] == "setInCart") {
        if (!isset($_SESSION["cart"]) ) {
            $_SESSION["cart"] = [];
        }
        if (isset($_SESSION["cart"])) {
            check_if_item_is_in_cart();
        }
    }
}

function print_shopping_cart() {
    $totalPrice = 0.00;
    $pdo = pdoObjectCart('clearsky');
    $sql = "SELECT * FROM producten WHERE ProductID = :ProductID";
    $stmt= $pdo->prepare($sql);
    
    foreach ($_SESSION['cart'] as $item) {
        $stmt->bindParam(':ProductID', $item['ProductID']);
        $stmt->execute();
        $products = $stmt->fetch(PDO::FETCH_ASSOC);

        // make the image useable
        $base64_image = base64_encode($products["Foto"]);

        // calculate the prices
        $price = $products['Prijs'];
        $priceProduct = $price * $item['amount'];
        $totalPrice += $priceProduct;
        if (isset($item['ProductID'])) {
            ?>
            <section class="product_in_cart_container">
                <img src="data:image/jpeg;base64, <?=$base64_image?>" class="cart_product_img">
                <section class="cart_product_info">
                    <h2><?=$products['Titel']?></h2>
                    <p>aantal: <a href='cart.php?min=<?=$item['ProductID']?>'>-</a> <a href=""></a> <?=$item['amount']?> <a href='cart.php?plus=<?=$item['ProductID']?>'>+</a></p>
                    <p>totaal: €<?=number_format($priceProduct, 2, '.', '')?></p>
                </section>
            </section>
            <?php
        }
    }
    ?>

    <section class="divider_50px"><!-- extra space --></section>
    <a href="afspraak.php" class="cart_buttons">Verder</a>
<?php
}

function plus_and_minus_items() {

    // add 1 to the amount of the product
    if(isset($_GET["plus"])) {
        foreach ($_SESSION['cart'] as $key => $item) {
            if($item["ProductID"] == $_GET['plus']) {
                $_SESSION['cart'][$key]['amount']++;
            }
        }
    }

    // delete 1 from the amount of the product
    if(isset($_GET["min"])) {
        foreach ($_SESSION['cart'] as $key => $item) {
            if ($item["ProductID"] == $_GET['min'] && $item["amount"] >= 1) {
                $_SESSION['cart'][$key]['amount']--;
            }
        }
    }
}

function delete_item() {

    // delete the product from the cart
    if(isset($_GET["min"])) {
        foreach ($_SESSION['cart'] as $key => $item) {
            if ($item["ProductID"] == $_GET['min'] && $item["amount"] == 0) {
                unset($_SESSION['cart'][$key]);
            }
        }
    }
}

?>