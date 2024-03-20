<?php
include("php/database_function.php");
session_start();

if (isset($_GET["productID"])) {
    $productID = $_GET["productID"];
    deleteProduct($productID);
}

function deleteProduct($productID) {
    $conn = pdoObject("clearsky");

    // Prepare SQL statement to delete the product
    $sql = "DELETE FROM producten WHERE ProductID = :productID";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':productID', $productID);
    
    // Execute the statement
    $stmt->execute();

    $_SESSION["MESSAGE"] = "Product is verwijderd";
    header("Location: home_admin.php");
}

?>
