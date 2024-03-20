<?php
session_start();
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
            $address = validateData(($_POST["address"]));
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
            createAccount($_POST["email"], $_POST["name"], password_hash($_POST["password"], PASSWORD_DEFAULT), $_POST["address"], $_POST["postal_code"]);
            $_SESSION["username"] = $_POST["name"];
            $_SESSION["email"] = $_POST["email"];
            if (isset($_SESSION["username"]) ) {
                header("location: index.php");
                exit();
            }
        }
    }
}

function createAccount($email, $username, $password, $address, $postal_code) {
    $pdo = pdoObject("clearsky");

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

    return $klantID;
}



function accountLogin() {
    if(isset($_POST["login"])) {
        $pdo = pdoObject("clearsky");
        $sql = "SELECT * FROM klant WHERE Email = :email";
        $stm = $pdo->prepare($sql);
        $stm->bindParam(':email', $_POST["email"]);
        $stm->execute();
        $user = $stm->fetch();

        if(password_verify($_POST["password"], $user["Wachtwoord"])) {
            $_SESSION["username"] = $user["Naam"];
            $_SESSION["email"] = $user["Email"];

            // Check if the user is an admin
            $isAdmin = isAdmin($user["KlantID"]);

            // Add the admin status to the session
            $_SESSION["admin"] = $isAdmin;

            if ($isAdmin) {
                header("location: home_admin.php");
                exit();
            }
            header("location: index.php");
            exit();
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
    $pdo = pdoObject("clearsky");
    $sql = "SELECT Admin FROM klantinfo WHERE klantID = :klantID";
    $stm = $pdo->prepare($sql);
    $stm->bindParam(':klantID', $klantID);
    $stm->execute();
    $adminStatus = $stm->fetchColumn();

    return $adminStatus == 1; // Assuming 1 represents admin, adjust if needed
}


?>