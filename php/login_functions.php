<?php

if (!isset($_SESSION['MESSAGE'])) {
    $_SESSION["MESSAGE"] = '';
}

function pdoObjectLogin($dbname) {
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
  
function validationPostalCode($str) {

    $str = str_replace(' ', '', $str);
    //postal code pattern
    $pattern = '/^\d{4}[A-Z]{2}$/';

        
    if (preg_match($pattern, $str)) {
        // postal code is valid
        return true; 
    } else {
        // postal code is not valid
        return false;
    }
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
            $address = validateData(($_POST["address"]));
        }
        if(empty(validateData($_POST["postal_code"])) ) {
            $postal_code = "";
        }
        else {
            $postal_code = validateData(($_POST["postal_code"]));
        }
          
        /* send error message when one of the fields is empty */
        if (empty($email) || empty($username) || empty($password) || empty($address) || empty($postal_code || !validationPostalCode( strtoupper($postal_code)) ) ) {
            if (empty($email) ) { 
                $_SESSION["MESSAGE"] .= "Email is verplicht<br>";
            }
            if (empty($username) ) { 
                $_SESSION["MESSAGE"] .= "Gebruikersnaam is verplicht<br>";
            }
            if (empty($password) ) { 
                $_SESSION["MESSAGE"] .= "Wachtwoord is verplicht<br>";
            }
            if (empty($address) ) { 
                $_SESSION["MESSAGE"] .= "Adres is verplicht<br>";
            }
            if (empty($postal_code) ) { 
                $_SESSION["MESSAGE"] .= "Postcode is verplicht<br>";
            }
            elseif (!validationPostalCode( strtoupper($postal_code) ) ) {
                $_SESSION["MESSAGE"] .= "Postcode is ongeldig<br>";
            }
        }
        else {
            createAccount($_POST["email"], $_POST["name"], password_hash($_POST["password"], PASSWORD_DEFAULT), $_POST["address"], strtoupper($_POST["postal_code"]) );
            header("location: index.php");
        }
    }
}

function createAccount($email, $username, $password, $address, $postal_code) {
    $pdo = pdoObjectLogin("clearsky");

    // Insert into "klant" table
    $sqlKlant = "INSERT INTO klant (Naam, Email, Wachtwoord, Adres, Postcode)
            VALUES (:username, :email, :password, :adres, :postcode)";
    $stmKlant = $pdo->prepare($sqlKlant);

    $stmKlant->bindParam(':username', $username);
    $stmKlant->bindParam(':email', $email);
    $stmKlant->bindParam(':password', $password);
    $stmKlant->bindParam(':adres', $address);
    $stmKlant->bindParam(':postcode', $postal_code);

    $stmKlant->execute();

    // Get the generated klantID
    $klantID = $pdo->lastInsertId();

    // Insert into "klantinfo" table
    $sqlKlantInfo = "INSERT INTO klantinfo (klantID, Admin)
            VALUES (:klantID, 0)";
    $stmKlantInfo = $pdo->prepare($sqlKlantInfo);

    $stmKlantInfo->bindParam(':klantID', $klantID);
    $stmKlantInfo->execute();

    $_SESSION["KlantID"] = intval($klantID);

    return $klantID;
}



function accountLogin() {
    if(isset($_POST["login"])) {
        $pdo = pdoObjectLogin("clearsky");
        $sql = "SELECT * FROM klant WHERE Email = :email";
        $stm = $pdo->prepare($sql);
        $stm->bindParam(':email', $_POST["email"]);
        $stm->execute();
        $user = $stm->fetch();

        if(password_verify($_POST["password"], $user["Wachtwoord"])) {
            $_SESSION['KlantID'] = $user["KlantID"];

            // Check if the user is an admin
            $isAdmin = isAdmin($user["KlantID"]);

            // Add the admin status to the session
            $_SESSION["admin"] = $isAdmin;

            if ($_SESSION["admin"] == false) {
                print("no admin");
                header("Refresh: 0; url=index.php");
                exit();
            }

            if ($_SESSION["admin"] == true) {
                print("admin");
                header("Refresh: 0; url=home_admin.php");
                exit();
            }
        } else {
            ?>
            <script>
                alert("Email of wachtwoord is onjuist");
            </script>
            <?php
        }
    }
}

// Function to check if the user is an admin
function isAdmin($klantID) {
    $pdo = pdoObjectLogin("clearsky");
    $sql = "SELECT Admin FROM klantinfo WHERE klantID = :klantID";
    $stm = $pdo->prepare($sql);
    $stm->bindParam(':klantID', $klantID);
    $stm->execute();
    $adminStatus = $stm->fetchColumn();

    return $adminStatus == 1; // Assuming 1 represents admin, adjust if needed
}

function redirect_user() {
    if (!isset($_SESSION['KlantID'])) {
        header("Location: login.php");
        exit();
    }
}

function redirect_no_admin() {
    if($_SESSION["admin"] == false) {
        header("Location: index.php");
        exit();
    }
}

?>