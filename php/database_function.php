<?php
function pdoObject($dbname) {
    $servername = "localhost";
    $user = "root";
    $pass = "";
    
    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $user, $pass);
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch(PDOException $e) {
        echo $e->getMessage();
    }
    return($conn);
}


function getProductId($product_id) {
    // get the productID from the database to use for the product page
    $pdo = pdoObject("clearsky");
    $sql = "SELECT * FROM producten WHERE productID = :productID";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':productID', $product_id);
    
    $stmt->execute();
    return $stmt;
}
?>