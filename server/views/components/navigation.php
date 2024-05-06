<!-- Header -->
<header id="header" class="site-header width-wrapper">
    <!-- Logo -->
    <p class="site-logo">
        <a href="#"><img src="./static/images/logo.jpg" alt="site-logo"></a>
    </p>

    <!-- Navigation -->

    <input type="checkbox" id="menu-toggle">
    <label for="menu-toggle" class="menu__btn">
        <span></span>
    </label>

    <!--Main nav-->
    <nav class="main-nav">
        <ul>
            <li><a href="./">Начало</a></li>
            <li><a href="./#about">За Нас</a></li>
            <li><a href="./events">Събития</a></li>
            <li><a href="./team">Екип</a></li>
            <li><a href="./contacts">Контакти</a></li>
        </ul>
    </nav>

    <!-- User Icon -->
    <div class="user">
        <ul class="user-icon">
            <li><a href="#" class="icn"><i class="fa-regular fa-circle-user"></i></a>
                <ul>
                    <?php
                    if (!isset($_SESSION["isLogged"])) {
                        /*Not logged users*/
                        echo '<li><a href="./login">Вход</a></li>';
                        echo '<li><a href="./register">Регистрация</a></li>';
                    } else {
                        /*Logged users only */
                        echo '<li><a href="profile.html">Профил</a></li>';

                        /*Only if the the user is admin */
                        if (isset($_SESSION["isLogged"]) && $_SESSION["role"] == 'admin') {
                            echo '<li><a href="./create">Ново събитие</a></li>';
                            echo '<li><a href="./panel?q=team">Панел</a></li>';
                        }

                        echo '<li><a href="./logout">Изход</a></li>';
                    }
                    ?>

                </ul>
            </li>
        </ul>
    </div>
</header>