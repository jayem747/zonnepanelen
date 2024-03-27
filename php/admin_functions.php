<?php

session_start();

require_once "database_function.php";

function validateData($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

function addProductAdmin() {
    if (isset($_POST["addProduct"])) {
        $conn = pdoObject("clearsky"); // Connect to the database

        // Get all the data from the form
        $naam = $_POST["naam"]; 
        $voorraad = $_POST["voorraad"];
        $prijs = $_POST["prijs"];
        $specificaties = $_POST["specificaties"];
        $omschrijving = $_POST["omschrijving"];
        if (isset($_FILES["product_image"]) && $_FILES["product_image"]["error"] == UPLOAD_ERR_OK) {
            $image = file_get_contents($_FILES["product_image"]["tmp_name"]); 
        } else {
            $image = file_get_contents("img/NoPicture.jpeg");
        }

        if (empty(validateData($naam))) {
            $naam = "";
        } else {
            $naam = validateData($naam);
        }

        if (empty(validateData($voorraad))) {
            $voorraad = "";
        } else {
            $voorraad = validateData($voorraad);
        }

        if (empty(validateData($prijs))) {
            $prijs = "";
        } else {
            $prijs = validateData($prijs);
        }

        if (empty(validateData($specificaties))) {
            $specificaties = "";
        } else {
            $specificaties = validateData($specificaties);
        }

        if (empty(validateData($omschrijving))) {
            $omschrijving = "";
        } else {
            $omschrijving = validateData($omschrijving);
        }

        if (empty($naam) || empty($voorraad) || empty($prijs) || empty($specificaties) || empty($omschrijving)) {
            if (empty($naam)) {
                $_SESSION["MESSAGE"] .= "Naam is verplicht<br>";
            }
            if (empty($voorraad)) {
                $_SESSION["MESSAGE"] .= "Voorraad is verplicht<br>";
            }
            if (empty($prijs)) {
                $_SESSION["MESSAGE"] .= "Prijs is verplicht<br>";
            }
            if (empty($specificaties)) {
                $_SESSION["MESSAGE"] .= "Specificaties is verplicht<br>";
            }
            if (empty($omschrijving)) {
                $_SESSION["MESSAGE"] .= "Omschrijving is verplicht<br>";
            }
        } else {
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

        if (empty(validateData($naam))) {
            $naam = "";
        } else {
            $naam = validateData($naam);
        }

        if (empty(validateData($voorraad))) {
            $voorraad = "";
        } else {
            $voorraad = validateData($voorraad);
        }

        if (empty(validateData($prijs))) {
            $prijs = "";
        } else {
            $prijs = validateData($prijs);
        }

        if (empty(validateData($specificaties))) {
            $specificaties = "";
        } else {
            $specificaties = validateData($specificaties);
        }

        if (empty(validateData($omschrijving))) {
            $omschrijving = "";
        } else {
            $omschrijving = validateData($omschrijving);
        }

        if (empty($naam) || empty($voorraad) || empty($prijs) || empty($specificaties) || empty($omschrijving)) {
            if (empty($naam)) {
                $_SESSION["MESSAGE"] .= "Naam is verplicht<br>";
            }
            if (empty($voorraad)) {
                $_SESSION["MESSAGE"] .= "Voorraad is verplicht<br>";
            }
            if (empty($prijs)) {
                $_SESSION["MESSAGE"] .= "Prijs is verplicht<br>";
            }
            if (empty($specificaties)) {
                $_SESSION["MESSAGE"] .= "Specificaties is verplicht<br>";
            }
            if (empty($omschrijving)) {
                $_SESSION["MESSAGE"] .= "Omschrijving is verplicht<br>";
            }
            if(isset($_FILES['product_image'])) {
                $file_size_kb = $_FILES['product_image']['size'] / 1024;
                if ($file_size_kb > 1024) {
                    $_SESSION["MESSAGE"] .= "Bestand is te groot (max 1mb)"; // Set error message
                    echo '<script>window.location.href = "edit_product.php?productID=' . $id . '";</script>'; // Redirect back to the edit product page
                    exit();
                }
            }
        } else {
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

            $_SESSION["MESSAGE"] = "Product <b>" . $naam . "</b> aangepast";
            echo '<script>window.location.href = "home_admin.php";</script>';
            exit();
        }
    }
}

