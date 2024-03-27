<?php
require_once("php/header_login.php");
require_once("php/login_functions.php");
?>

        <div class="main_content">
            <?php var_dump($_SESSION) ?>
            <div class="login_formation">
                <!-- Left ad -->
                <section class="vertical_ad">
                    advertentie
                </section>

                <!-- middle box -->
                <form class="login_container" method="post" action="">
                    <h1 class="blue_top_text">Log in</h1>
                    <section class="divider_50px"><!-- divider --></section>
                    <input type="email" name="email" placeholder="E-mail">
                    <input type="password" name="password" placeholder="Wachtwoord">
                    <input type="submit" name="login" value="Log in">
                    <a href="forgot_password.php">Wachtwoord vergeten?</a>
                    <a href="register.php">Geen account? Registreer hier</a>
                </form>

                <!-- Right ad -->
                <section class="vertical_ad">
                    advertentie
                </section>
            </div>
        </div>

        <script src="https://kit.fontawesome.com/74f00c029b.js" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js"></script>
        <script src="js/animations.js"></script>
    </body>
</html>

<?php
accountLogin()
?>