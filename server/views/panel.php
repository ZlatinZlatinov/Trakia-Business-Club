<?php 
include('./config/connect_db.php'); 
$queue = $_GET["q"];
?>

<main class="site-main">
    <section id="admin-panel">
        <h2 class="section-heading">Админ Панел</h2>

        <div class="panel-container width-wrapper">

            <!--Panel Sidebar -->
            <div class="panel-sidebar">
                <ul class="panel-nav">
                    <li><a href="./panel?q=team">Екип</a></li>
                    <li><a href="./panel?q=partners">Партньори</a></li>
                    <li><a href="./panel?q=content">Съдържание</a></li>
                </ul>
            </div>

            <!--Admin panel -->
            <div id="panel">
                <h2 value="<?php echo $_GET["q"] ?>"><?php
                                                    if ($_GET["q"] == 'team') {
                                                        echo "Екип";
                                                    } else if ($_GET["q"] == "partners") {
                                                        echo "Партньори";
                                                    } else if ($_GET["q"] == "content") {
                                                        echo "Съдържание";
                                                    }
                                                    ?></h2>

                <button class="add-button"><i class="fa-solid fa-plus"></i> Добави</button>

                <ul>
                    <?php
                    $sql = "SELECT * from $queue";
                    //TODO add err handling
                    $result;
                    try {
                        $result = mysqli_query($connection, $sql);
                    } catch (mysqli_sql_exception) {
                        http_response_code(404);
                        header("Location: ./404");
                        exit();
                    }

                    while ($row = mysqli_fetch_assoc($result)) {
                        $name = $row['name'];
                        $title = $row['title'];
                        $imgURL = $row['imgURL'];

                    ?>
                        <li id="<?php echo $row["id"] ?>">
                            <div class="img-author">
                                <img src="./<?php echo $imgURL ?>" alt="<?php echo $name ?>">
                                <div>

                                    <span class="title"><?php echo $name ?></span>
                                    <span class="author"><?php echo $title ?></span>
                                </div>
                            </div>

                            <div class="admin-buttons">
                                <button class="edit-btn"><i class="fa-regular fa-pen-to-square"></i> Редактирай</button>
                                <form action="./panel?q=<?php echo $queue?>" method="POST">
                                    <input type="hidden" name="delete-team" value="<?php echo $row["id"] ?>">
                                    <button type="submit" class="delete-btn"><i class="fa-regular fa-trash-can"></i> Изтрий</button>
                                </form>
                            </div>
                        </li>

                    <?php } ?>
                </ul>
            </div>
        </div>
    </section>
</main>

<script src="./jsScripts/adminPanel.js?v=<?php echo time(); ?>" type="text/javascript" defer></script>

<?php
//TODO: there is some bug with reloading page
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (isset($_POST['add-team'])) {
        //Add new team member:

        if ($_FILES["image"]["error"] == 0) {
            $memberName = $_POST["memberName"];
            $title = $_POST["title"];

            $imgName = $_FILES["image"]["name"];
            $tmp_name  = $_FILES["image"]["tmp_name"];

            $imgUrl = "uploads/{$queue}/" . uniqid() . '-' . $imgName;
            move_uploaded_file($tmp_name, $imgUrl);

            $sql = "INSERT INTO `{$queue}` (name, title, imgURL) VALUES ('{$memberName}', '{$title}', '{$imgUrl}')";

            try {
                mysqli_query($connection, $sql);
            } catch (mysqli_sql_exception) {
                die("Oops something went wrong: " . mysqli_error($connection));
            }

            mysqli_close($connection);
        }
    } else if (isset($_POST["edit-team"])) {
        //Edit Team member
        if ($_FILES["image"]["error"] == 0) {
            $memberName = $_POST["memberName"];
            $title = $_POST["title"];
            $teamid = intval($_POST["team-id"]); 
            $imgName = $_FILES["image"]["name"];
            $tmp_name  = $_FILES["image"]["tmp_name"];

            $imgUrl = "uploads/{$queue}/" . uniqid() . '-' . $imgName;
            move_uploaded_file($tmp_name, $imgUrl);

            $sql = "UPDATE `{$queue}` SET name = '{$memberName}', title = '{$title}', imgURL = '{$imgURL}' WHERE id = $teamid";

            try {
                mysqli_query($connection, $sql);
            } catch (mysqli_sql_exception) {
                mysqli_close($connection);
                die("Oops something went wrong: " . mysqli_error($connection));
            }
            mysqli_close($connection);
        }
    } else if (isset($_POST["delete-team"])) {
        //Delete from Team:

        $teamId = intval($_POST["delete-team"]);
        $sql = "DELETE FROM $queue WHERE id = $teamId";
        mysqli_query($connection, $sql);
        mysqli_close($connection);
        // header("Location: ./panel?q={$queue}");
    }
}
?>