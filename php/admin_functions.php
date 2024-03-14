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

function editProductAdmin() {
    if (isset($_POST["editProduct"])) {
        $conn = pdoObject("clearsky");

        $id = $_POST["id"];
        $naam = $_POST["naam"];
        $voorraad = $_POST["voorraad"];
        $prijs = $_POST["prijs"];
        $specificaties = $_POST["specificaties"];
        $omschrijving = $_POST["omschrijving"];

        if (isset($_FILES["product_image"]) && $_FILES["product_image"]["error"] == UPLOAD_ERR_OK) {
            $image = file_get_contents($_FILES["product_image"]["tmp_name"]);
        } else {
            $stmt = $conn->prepare("SELECT Foto FROM producten WHERE ProductID = :id");
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            $oldImage = $stmt->fetch(PDO::FETCH_ASSOC);
            $image = $oldImage['Foto'];
        }
        
        $sql = "UPDATE producten SET Titel = :naam, Voorraad = :voorraad, Prijs = :prijs, Specificaties = :specificaties, Omschrijving = :omschrijving, Foto = :image WHERE ProductID = :id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':naam', $naam);
        $stmt->bindParam(':voorraad', $voorraad);
        $stmt->bindParam(':prijs', $prijs);
        $stmt->bindParam(':specificaties', $specificaties);
        $stmt->bindParam(':omschrijving', $omschrijving);
        $stmt->bindParam(':image', $image, PDO::PARAM_LOB);
        
        $stmt->execute();

        // Use JavaScript to redirect after the update
        echo '<script>window.location.href = "home_admin.php";</script>';
        exit();  // Ensure that no further code is executed after the redirection
    }
}

