<main class="site-main">

    <!-- #Team -->
    <section id="team">
        <h2 class="section-heading">Нашият Екип</h2>

        <div class="width-wrapper">
            <!-- team-card -->
            <?php
            include('./config/connect_db.php');
            $sql = "SELECT * from team";
            $result = mysqli_query($connection, $sql);

            while ($row = mysqli_fetch_assoc($result)) {
                $name = $row['name'];
                $title = $row['title'];
                $imgURL = $row['imgURL'];

            ?>
                <div class="team-card">
                    <img src="./<?php echo $imgURL ?>" alt="<?php echo $name ?>">

                    <div>
                        <h3><?php echo $name ?></h3>
                        <span><?php echo $title ?></span>
                    </div>
                </div>

            <?php } ?>
        </div>
    </section>
</main>