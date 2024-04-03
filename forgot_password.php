<?php
require_once("php/header_login.php");
if (isset($_POST["forgot_password"])) {
    $_SESSION["MESSAGE"] = "Er is een email gestuurd naar " . $_POST["email"];
    header("location: login.php");
}
?>
    <div class="main_content">
        <div class="login_formation">
            <!-- Left ad -->
            <section class="vertical_ad">
                <!-- advertentie -->
            </section>

            <!-- middle box -->
            <form class="login_container" method="post" action="">
                <h1 class="blue_top_text">Forgot Password</h1>
                <section class="divider_50px"><!-- divider --></section><br>
                <input type="text" name="email" placeholder="Email">
                <br><br>
                <input type="submit" name="forgot_password" value="Stuur email">
                <a href="login.php">Terug naar login</a>
                <a href="register.php">Terug naar registreer</a>
            </form>

            <!-- Right ad -->
            <section class="vertical_ad">
                <!-- advertentie -->
            </section>
        </div>
    </div>

        <script src="https://kit.fontawesome.com/74f00c029b.js" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js"></script>
        <script src="js/animations.js"></script>
    </body>
</html>