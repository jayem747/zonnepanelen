<?php
require_once("php/header_login.php");
?>

        <div class="main_content">
            <div class="login_formation">
                <!-- Left ad -->
                <section class="vertical_ad">
                    advertentie
                </section>

                <!-- middle box -->
                <form class="login_container" method="post" action="index.php">
                    <h1 class="blue_top_text">Log in</h1>
                    <section class="divider_50px"><!-- space between ad and welcome section --></section>
                    <input type="text" name="name" placeholder="Gebruikersnaam">
                    <input type="text" name="password" placeholder="wachtwoord">
                    <input type="submit">
                    <section class="divider_50px"><!-- space between ad and welcome section --></section>
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
