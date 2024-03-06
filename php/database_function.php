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
        echo $sql . "<br>" . $e->getMessage();
    }
    return($conn);
}


function getProductId($product_id) {
    $pdo = pdoObject("clearsky");
    $sql = "SELECT * FROM producten WHERE productID = :productID";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':productID', $product_id);
    
    $stmt->execute();
    return $stmt;
}
?>