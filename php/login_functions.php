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

function validateData($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }
  
  /* check all the fields */
  function validateAccountRegistration() {
  
    if(isset($_POST["register"])) {
        /* checks if input is empty */
        if(empty(validateData($_POST["email"])) ) {
            $email = "";
        }
        else {
            $email = validateData(($_POST["email"]));
        }
        if(empty(validateData($_POST["name"])) ) {
            $username = "";
        }
        else {
            $username = validateData(($_POST["name"]));
        }
        if(empty(validateData($_POST["password"])) ) {
            $password = "";
        }
        else {
            $password = validateData(($_POST["password"]));
        }
        if(empty(validateData($_POST["address"])) ) {
            $address = "";
        }
        else {
            $password = validateData(($_POST["address"]));
        }
        if(empty(validateData($_POST["postal_code"])) ) {
            $postal_code = "";
        }
        else {
            $postal_code = validateData(($_POST["postal_code"]));
        }
          
        /* send error message when one of the fields is empty */
        if (empty($email) || empty($username) || empty($password) ) {
            session_destroy();
            if (empty($email) ) { 
                ?>
                <script>
                    alert("Email is verplicht");
                </script>
                <?php
            }
            if (empty($username) ) { 
                ?>
                <script>
                    alert("gebruikersnaam is verplicht");
                </script>
                <?php
            }
            if (empty($password) ) { 
                ?>
                <script>
                    alert("wachtwoord is verplicht");
                </script>
                <?php
            }
        }
        // code that inserts comment
        else {
            createAccount($_POST["email"], $_POST["username"], password_hash($_POST["password"], PASSWORD_DEFAULT));
            $_SESSION["username"] = $_POST["username"];
            $_SESSION["email"] = $user["email"];
            $_SESSION["password"] = $user["password"];
            if (isset($_SESSION["username"]) ) {
                header("location: index.php");
            }
        }
    }
}

function createAccount($email, $username, $password, $address, $postal_code) {
    $pdo = pdoObject("clearsky");
    $sql = "INSERT INTO klant (Naam, Email, Wachtwoord, Adres, Postcode)
            VALUES (:username, :email, :wachtwoord, :adres, :postcode )";
    $stm = $pdo->prepare($sql);
    
    $stm->bindParam(':username', $username);
    $stm->bindParam(':email', $email);
    $stm->bindParam(':password', $password);
    $stm->bindParam(':adres', $address);
    $stm->bindParam(':postcode', $postal_code);
    
    $stm->execute();
    $user = $stm->fetch();

    return $user;
}


?>