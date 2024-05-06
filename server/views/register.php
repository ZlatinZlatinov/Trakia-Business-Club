<?php
/*
TODO: input fields need validation on the html part, strong passwords and valied emails
*/

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include("./utils/verify.php");

    // Robot test
    if (verifyUser()) {
        $username = filter_input(INPUT_POST, "username", FILTER_SANITIZE_SPECIAL_CHARS); //$_POST["username"];
        $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL); //$_POST["email"];
        $password = $_POST["password"];
        $rePassword = $_POST["rePassword"];

        if (!empty($username) || !empty($email) || !empty($password) || !empty($rePassword)) {
            /*Check for matching passwords */
            if($password !== $rePassword){
                die("Полета Парола и Повтори парола трябва да са еднакви!");
            }

            include("./config/connect_db.php");
            include('./utils/mailSender.php');

            /*Hashing the password */
            $hashed_pass = password_hash($password, PASSWORD_BCRYPT);
            
            /*Generating verification code */
            $verification_code = substr(number_format(time() * rand(), 0, '', '',), 0, 6);

            /*Adding subject and message to the email */
            $subject = "Email verification";
            $message = '<p>Your verification code is: <b style=font-size: 30px;">' .
                $verification_code . '</b></p>';

            /*If the email is sent succesfully, a new row is added to the db */
            if (sendEmail($email, $subject, $message)) {
                try {
                    $sql = "INSERT INTO users(username, email, password, verification_code) VALUES('{$username}', '{$email}', '{$hashed_pass}', '{$verification_code}')";
                    
                    /*Row Insertion */
                    mysqli_query($connection, $sql);

                    header("Location: ./email-verification?email={$email}");
                } catch (mysqli_sql_exception) {
                    die("Oops something went wrong: " . mysqli_error($connection));
                }

                mysqli_close($connection);
            } else {
                die('Message was not delivered :(');
            }
        } else {
            echo "<div class='result'>
    <h2>Wrong Input</h2>
</div>";
        }
    } else {
        echo "You are robot!";
    }
}
?>

<main class="site-main">

    <!--Register-->
    <section id="register">
        <div class="width-wrapper">
            <!--Form Container-->
            <div class="form-container">

                <!--Section Heading-->
                <h2 class="section-heading">Регистрация</h2>

                <!--Register Form-->
                <form action="<?php htmlspecialchars($_SERVER["PHP_SELF"])?>" method="POST" id="register-form">
                    <div>
                        <label for="username">Потребителско име</label>
                        <input type="text" name="username" id="username" value="<?php if(isset($email)){ echo $email; }else{ echo '';}?>">
                    </div>

                    <div>
                        <label for="email">Имейл</label>
                        <input type="email" name="email" id="email">
                    </div>

                    <div>
                        <label for="password">Парола</label>
                        <input type="password" name="password" id="password" value="<?php if(isset($password)){ echo $password;} else{ echo '';}?>">
                    </div>

                    <div>
                        <label for="re-pass">Повтори парола</label>
                        <input type="password" name="rePassword" id="rePassword">
                    </div>
                    <div>
                        <div class="g-recaptcha" data-sitekey="6LfTOKMpAAAAAD4LXNpAWSlyz5xFFvcy2kqS3d2M"></div>
                    </div>

                    <input type="submit" id="submit-btn" value="Регистрация">
                </form>
            </div>

        </div>

    </section>
</main>