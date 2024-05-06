<footer id="site-footer">
        <div class="site-footer width-wrapper">
            <p class="site-logo">
                <a href="#"><img src="./static/images/logo.jpg" alt="site-logo"></a>
            </p>

            <ul class="footer-nav">
                <li><a href="./">Начало</a></li>
                <li><a href="./#about">За Нас</a></li>
                <li><a href="./events">Събития</a></li>
                <li><a href="./team">Екип</a></li>
            </ul>

            <ul class="footer-nav">
                <li><a href="./contacts">Контакти</a></li>
                <li><a href="questions.html">ЧЗВ</a></li>
                <?php
                        if(!isset($_SESSION["isLogged"])) { 
                            /*Not logged users*/
                            echo '<li><a href="./login">Вход</a></li>';
                            echo '<li><a href="./register">Регистрация</a></li>';
                        } else {
                            /*Logged users only */
                            echo '<li><a href="profile.html">Профил</a></li>';
                        } 
                ?>
            </ul>

            <ul class="socials">
                <li><a href="#"><i class="fa-brands fa-meta"></i></a></li>
                <li><a href="#"><i class="fa-brands fa-youtube"></i></a></li>
                <li><a href="#"><i class="fa-brands fa-x-twitter"></i></a></li>
                <li><a href="#"><i class="fa-brands fa-linkedin-in"></i></a></li>
            </ul>
        </div>

        <p class="copyright">&copy; 2024 Всички права запазени.</p>
    </footer>