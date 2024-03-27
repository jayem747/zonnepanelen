<?php

require_once("database_function.php");
require_once("login_functions.php");

function validateAfspraak() {
    if (isset($_POST["afspraak"])) {
        $afspraak = $_POST["afspraak"];
    }
};

function payment() {
    if (isset($_POST["payment_card"])) {
        $conn = pdoObject("clearsky"); // Connect to the database

        // Alle posts in variabelen zetten
        $klantID = $_SESSION["KlantID"];
        $fullName = $_POST["fullName"];
        $phoneNumber = $_POST["phoneNumber"];
        $afspraak = $_POST["afspraak"];
        $email = $_POST["email"];
        $card_number = $_POST["card_number"];
        $expiry_date = $_POST["expiry_date"];
        $cvc = $_POST["cvc"];
        $name_on_card = $_POST["name_on_card"];
        $address = $_POST["address"];
        $postcode = $_POST["postcode"];

        // Validaten van de data
        if (empty(validateData($fullName))) {
            $fullName = "";
        } else {
            $fullName = validateData($fullName);
        }
        if (empty(validateData($phoneNumber))) {
            $phoneNumber = "";
        } else {
            $phoneNumber = validateData($phoneNumber);
        }
        if (empty(validateData($afspraak))) {
            $afspraak = "";
        } else {
            $afspraak = validateData($afspraak);
        }
        if (empty(validateData($email))) {
            $email = "";
        } else {
            $email = validateData($email);
        }
        if (empty(validateData($card_number))) {
            $card_number = "";
        } else {
            $card_number = validateData($card_number);
        }
        if (empty(validateData($expiry_date))) {
            $expiry_date = "";
        } else {
            $expiry_date = validateData($expiry_date);
        }
        if (empty(validateData($cvc))) {
            $cvc = "";
        } else {
            $cvc = validateData($cvc);
        }
        if (empty(validateData($name_on_card))) {
            $name_on_card = "";
        } else {
            $name_on_card = validateData($name_on_card);
        }
        if (empty(validateData($address))) {
            $address = "";
        } else {
            $address = validateData($address);
        }
        if (empty(validateData($postcode))) {
            $postcode = "";
        } else {
            $postcode = validateData($postcode);
        }

        // Checken of de velden leeg zijn
        if (empty($fullName) || empty($phoneNumber) || empty($afspraak) || empty($email) || empty($card_number) || empty($expiry_date) || empty($cvc) || empty($name_on_card) || empty($address) || empty($postcode)) {
            if (empty($fullName)) {
                $_SESSION["MESSAGE"] .= "Naam is verplicht<br>";
            }
            if (empty($phoneNumber)) {
                $_SESSION["MESSAGE"] .= "Telefoonnummer is verplicht<br>";
            }
            if (empty($afspraak)) {
                $_SESSION["MESSAGE"] .= "Afspraak is verplicht<br>";
            }
            if (empty($email)) {
                $_SESSION["MESSAGE"] .= "Email is verplicht<br>";
            }
            if (empty($card_number)) {
                $_SESSION["MESSAGE"] .= "Kaartnummer is verplicht<br>";
            }
            if (empty($expiry_date)) {
                $_SESSION["MESSAGE"] .= "Vervaldatum is verplicht<br>";
            }
            if (empty($cvc)) {
                $_SESSION["MESSAGE"] .= "CVC is verplicht<br>";
            }
            if (empty($name_on_card)) {
                $_SESSION["MESSAGE"] .= "Naam op kaart is verplicht<br>";
            }
            if (empty($address)) {
                $_SESSION["MESSAGE"] .= "Adres is verplicht<br>";
            }
            if (empty($postcode)) {
                $_SESSION["MESSAGE"] .= "Postcode is verplicht<br>";
            }            
        } else {
            // Alles in de database gooien
            $sql = "INSERT INTO facturen (KlantID, Naam, Adres, Postcode, Email, Telefoonnummer, Datum) VALUES (:klantID, :naam, :adres, :postcode, :email, :telefoonnummer, :datum)";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':klantID', $klantID);
            $stmt->bindParam(':naam', $fullName);
            $stmt->bindParam(':adres', $address);
            $stmt->bindParam(':postcode', $postcode);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':telefoonnummer', $phoneNumber);
            $stmt->bindParam(':datum', $afspraak);
            $stmt->execute();

            // Pak het laatst toegevoegde id
            $factuurID = $conn->lastInsertId();

            // Loop door de cart en voeg de producten toe aan de factuur_regel tabel
            foreach ($_SESSION["cart"] as $item) {
                $sql = "INSERT INTO factuur_regel (FactuurID, ProductID, Amount) VALUES (:factuurID, :productID, :amount)";
                $stmt = $conn->prepare($sql);
                $stmt->bindParam(':factuurID', $factuurID);
                $stmt->bindParam(':productID', $item["ProductID"]);
                $stmt->bindParam(':amount', $item["amount"]);
                $stmt->execute();
            };

            // Unset de cart en geef een succes melding
            $_SESSION["succes"] = "Betaling succesvol";
            $_SESSION["cart"] = array();
            header("location: index.php");
        };
    };
};

?>