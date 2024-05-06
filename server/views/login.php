<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include "./utils/verify.php";

    //Checks if user is robot
    if (verifyUser()) {
        $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL); //$_POST["email"];
        $password = $_POST["password"];

        if (!empty($email) && !empty($password)) {

            include("./config/connect_db.php");
            $sql = "SELECT * FROM users WHERE `email` = '{$email}'";

            try {
                $result = mysqli_query($connection, $sql);

                if (mysqli_num_rows($result) > 0) {
                    $row = mysqli_fetch_assoc($result);
                       
                    if($row["email_verified_at"] !== null){
                        if (password_verify($password, $row["password"])) {
                            $_SESSION["isLogged"] = true;
                            $_SESSION["username"] = $row["username"];
                            $_SESSION["user_id"] = $row["id"];
                            $_SESSION["role"] = $row["role"];

                            header("Location: ./home");
                        } else {
                            echo "Wrong username or password";
                        }
                    } else {
                        header("Location: ./email-verification?email={$email}");
                    }

                } else {
                    echo "Wrong username or password";
                }
            } catch (mysqli_sql_exception) {
                echo "Wrong username or password";
                die("Oops something went wrong " . mysqli_error($connection));
            }

            mysqli_close($connection);
        } else {
            echo "Enter valid Email addres";
        }
    } else {
        echo "You are robot!";
    }
}

?>

<main class="site-main">
        <!-- #Auth -->
        <section id="login">
            <div class="width-wrapper">
                <!--Form Container-->
                <div class="form-container">

                    <!--Section Heading-->
                    <h2 class="section-heading">Вход</h2>

                    <!--Register Form-->
                    <form action="<?php htmlspecialchars($_SERVER["PHP_SELF"])?>" method="POST" id="login-form">

                        <div>
                            <label for="email">Имейл</label>
                            <input type="email" name="email" id="email">
                        </div>

                        <div>
                            <label for="password">Парола</label>
                            <input type="password" name="password" id="password">
                        </div>

                        <div>
                            <div class="g-recaptcha" data-sitekey="6LfTOKMpAAAAAD4LXNpAWSlyz5xFFvcy2kqS3d2M"></div>
                        </div>

                        <input type="submit" id="submit-btn" value="Вход">
                    </form>
                </div>

            </div>

        </section>
    </main>