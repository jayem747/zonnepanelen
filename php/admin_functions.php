<?php

session_start();

require_once "database_function.php";

function addProductAdmin() {
    if (isset($_POST["addProduct"])) {
        $conn = pdoObject("clearsky");

        $naam = $_POST["naam"];
        $voorraad = $_POST["voorraad"];
        $prijs = $_POST["prijs"];
        $specificaties = $_POST["specificaties"];
        $omschrijving = $_POST["omschrijving"];
        // $image = $_FILES["product_image"]["tmp_name"];
        // $image = file_get_contents($image);
        // $image = base64_encode($image);
        $image = file_get_contents($_FILES["product_image"]["tmp_name"]);
        
        $sql = "INSERT INTO producten (Titel, Voorraad, Prijs, Specificaties, Omschrijving, Foto) VALUES (:naam, :voorraad, :prijs, :specificaties, :omschrijving, :image)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':naam', $naam);
        $stmt->bindParam(':voorraad', $voorraad);
        $stmt->bindParam(':prijs', $prijs);
        $stmt->bindParam(':specificaties', $specificaties);
        $stmt->bindParam(':omschrijving', $omschrijving);
        $stmt->bindParam(':image', $image, PDO::PARAM_LOB);
        
        $stmt->execute();

        echo "Product toegevoegd";
    }
}