<?php

session_start();

require_once "database_function.php";

function addProductAdmin() {
    if (isset($_POST["addProduct"])) {
        $conn = pdoObject("clearsky"); // Connect to the database

        // Get all the data from the form
        $naam = $_POST["naam"]; 
        $voorraad = $_POST["voorraad"];
        $prijs = $_POST["prijs"];
        $specificaties = $_POST["specificaties"];
        $omschrijving = $_POST["omschrijving"];
        $image = file_get_contents($_FILES["product_image"]["tmp_name"]); 
        
        // Insert the data into the database
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
        $conn = pdoObject("clearsky"); // Connect to the database

        // Get all the data from the form
        $id = $_POST["id"];
        $naam = $_POST["naam"];
        $voorraad = $_POST["voorraad"];
        $prijs = $_POST["prijs"];
        $specificaties = $_POST["specificaties"];
        $omschrijving = $_POST["omschrijving"];

        // Check if a new image is uploaded
        if (isset($_FILES["product_image"]) && $_FILES["product_image"]["error"] == UPLOAD_ERR_OK) {
            $image = file_get_contents($_FILES["product_image"]["tmp_name"]);
        } else {
            // If no new image is uploaded, use the old image
            $stmt = $conn->prepare("SELECT Foto FROM producten WHERE ProductID = :id");
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            $oldImage = $stmt->fetch(PDO::FETCH_ASSOC);
            $image = $oldImage['Foto'];
        }
        
        // Update the data in the database
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

