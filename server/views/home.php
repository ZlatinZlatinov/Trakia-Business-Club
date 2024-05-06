<?php include('./config/connect_db.php'); ?>

<main class="site-main">

    <!-- #Intro -->
    <section id="intro">
        <img src="./static/images/hero2.png" alt="hero_img">

        <h1 class="site-theme">Тракийски Университет Бизнес Клуб</h1>
    </section>

    <!-- #About -->
    <?php
    $sql = "SELECT * from content";

    $result = mysqli_query($connection, $sql);

    if (mysqli_num_rows($result) !== 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $heading = $row["name"];
            $text = $row["title"];
            $imgUrl = $row["imgURL"];

    ?>
            <section id="about">
                <h2 class="section-heading"><?php echo $heading; ?></h2>
                <div class="width-wrapper">
                    <img src="./<?php echo $imgUrl; ?>" alt="about_us">

                    <div class="about-us">

                        <p><?php echo $text; ?></p>

                        <a href="#" class="join-btn">Присъедини се</a>

                    </div>
                </div>
            </section>
    <?php }
    } else {
        include("./views/components/aboutComponent.php");
    }
    ?>

    <!-- #Goals -->
    <section id="goals">
        <h2 class="section-heading">Нашите Цели</h2>

        <div class="width-wrapper">
            <!-- goal-card -->
            <div class="goal-card hidden">
                <span>
                    <i class="fa-solid fa-people-group"></i>
                </span>

                <div>
                    <h3><strong>Силна Общност</strong></h3>
                    <p>Развитие на силна общност от студенти в Стопанския факултет чрез организиране на
                        редовни събития, семинари и практически обучения, като същевременно се насърчават
                        връзките между тях и менторите от различни сектори.</p>
                </div>
            </div>

            <!-- goal-card -->
            <div class="goal-card hidden">
                <span>
                    <i class="fa-solid fa-handshake"></i>
                </span>

                <div>
                    <h3><strong>Дългосрочни Партньорства</strong></h3>

                    <p>Установяване на дългосрочни партньорства с местни и международни организации, което
                        да позволи на членовете на клуба да придобият практически опит и да получат представа
                        за различни индустрии.</p>
                </div>
            </div>

            <!-- goal-card -->
            <div class="goal-card hidden">
                <span>
                    <i class="fa-solid fa-graduation-cap"></i>
                </span>

                <div>
                    <h3><strong>Активно Участие</strong></h3>

                    <p>Популяризиране на активно участие на студентите в академичните среди и извън тях, като
                        организираме редовни публични лекции, панелни дискусии и конференции, включващи експерти
                        от различни области.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- #Partners -->
    <section id="partners">
        <h2 class="section-heading">Партньори</h2>

        <div class="width-wrapper">
            <!-- Partner-card -->
            <?php
            $sql = "SELECT * FROM partners";
            $result = mysqli_query($connection, $sql);

            while ($row = mysqli_fetch_assoc($result)) {
                $imgUrl = $row["imgURL"];
                $name = $row["name"];

            ?>
                <div class="partner-card">
                    <img src="./<?php echo $imgUrl; ?>" alt="<?php echo $name; ?>">
                </div>

            <?php } ?>
        </div>
    </section>
</main>

<button id="back-to-top">
    <i class="fa-solid fa-chevron-up"></i>
</button>
<!-- Scripts -->
<script defer src="./jsScripts/index.js"></script>
<script defer src="./jsScripts/animation.js"></script>