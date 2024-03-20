<?php
require_once("php/header_login.php");
require_once("php/login_functions.php");

validateAccountRegistration();
?>

    <div class="main_content">
        <div class="login_formation">
            <!-- Left ad -->
            <section class="vertical_ad">
                advertentie
            </section>

            <!-- middle box -->
            <form class="login_container" method="post" action="">
                <h1 class="blue_top_text">registreer</h1>
                <?php
                if (isset($_SESSION["MESSAGE"])) {
                    echo "<p class='admin_message'>" . $_SESSION["MESSAGE"] . "</p><br>";
                    unset($_SESSION["MESSAGE"]);
                }
                ?>
                <section class="divider_50px"><!-- divider --></section>
                <input type="text" name="name" placeholder="Gebruikersnaam">
                <input type="email" name="email" placeholder="Email">
                <input type="password" name="password" placeholder="wachtwoord">
                <input type="text" name="address" placeholder="adres">
                <input type="text" name="postal_code" placeholder="postcode">
                <input type="submit" name="register" value="Registreer">
                <a href="login.php">heeft u al een account? log hier in</a>
            </form>

            <!-- Right ad -->
            <section class="vertical_ad">
                advertentie
            </section>
        </div>
    </div>
    <section class="divider_50px"><!-- divider --></section>

        <script src="https://kit.fontawesome.com/74f00c029b.js" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js"></script>
        <script src="js/animations.js"></script>
    </body>
</html>

<?php
?>