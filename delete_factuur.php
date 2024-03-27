<?php
include("php/database_function.php");
session_start();

if (isset($_GET["factuurID"])) {
    $factuurID = $_GET["factuurID"];
    deleteProduct($factuurID);
}

function deleteProduct($factuurID) {
    $conn = pdoObject("clearsky");

    // Delete related records from factuur_regel table first
    $sql = "DELETE FROM factuur_regel WHERE FactuurID = :factuurID";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':factuurID', $factuurID);
    
    // Execute the statement
    $stmt->execute();

    // Then delete the record from facturen table
    $sql = "DELETE FROM facturen WHERE FactuurID = :factuurID";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':factuurID', $factuurID);

    // Execute the statement
    $stmt->execute();

    $_SESSION["MESSAGE"] = "Factuur is verwijderd";
    header("Location: admin_afspraken.php");
}


?>
