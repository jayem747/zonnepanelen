<?php
function pdoObjectCart($dbname) {
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
//function to check if the size and id are inside the session
function check_if_item_is_in_cart() {
    $isNewItem = true;
    foreach ($_SESSION['cart'] as &$item) {
        if ($item["ProductID"] == $_POST['ProductID']) {
            $item['amount'] += intval($_POST['amount']);
            $isNewItem = false;
            break;
        }
    }
    if ($isNewItem && isset($_POST['ProductID'])) {
        array_push($_SESSION["cart"], [ "ProductID" => $_POST['ProductID'], "amount" => intval($_POST["amount"]) ]);
        $_POST['ProductID'] = null;
        $_POST['amount'] = null;
        $isNewItem = false;
    }
        
}

function add_to_cart() {
    $isNewItem = true;
    foreach ($_SESSION['cart'] as $item) {
        if (isset($item['ProductID']) && $item['ProductID'] == $_POST['ProductID']) {
            $item['amount'] += intval($_POST['amount']);
            $isNewItem = false;
            break;
        }    
    }
     if ($isNewItem && isset($_POST['ProductID']) && isset($_POST['amount']) ) {
        array_push($_SESSION['cart'], ["ProductID" => $_POST['ProductID'], "amount" => $_POST['amount'] ]);
        $_POST['ProductID'] = null;
        $_POST['amount'] = null;
        $isNewItem = false;
        
    }
}

//function to create a session cart and uses checkifitemisincart function
function shopping_cart() {
    $pdo = pdoObjectCart("clearsky");
    if (isset($_POST["setInCart"]) && $_POST["action"] == "setInCart") {
        if (!isset($_SESSION["cart"]) ) {
            $_SESSION["cart"] = [];
        }
        else {
            check_if_item_is_in_cart();
        }
    }
    if (isset($_POST["setInCart"]) && $_POST["action"] == "setInCart") {
        if (!isset($_SESSION["cart"]) ) {
            $_SESSION["cart"] = [];
        }
        else {
            add_to_cart();
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
        $base64_image = base64_encode($products["Foto"]);
        $price = $products['Prijs'];
        $priceProduct = $price * $item['amount'];
        
        $totalPrice += $priceProduct;
        if (isset($item['ProductID'])) {
            ?>
            <section class="product_in_cart_container">
                <img src="data:image/jpeg;base64, <?=$base64_image?>" class="cart_product_img">
                <section class="cart_product_info">
                    <h2><?=$products['Titel']?></h2>
                    <p>aantal: <?=$item['amount']?></p>
                    <p>totaal: €<?=number_format($priceProduct, 2, '.', '')?></p>
                </section>
            </section>
            <?php
        }
    }
    ?>

    <section class="divider_50px"><!-- extra space --></section>
    <a href="payment.php" class="cart_buttons">Betaal</a>
    <a href="#" class="cart_buttons">Afspraak</a>
<?php
}

?>