<?php 
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $email = $_POST["email"]; 
        $verification_code = $_POST["verification_code"]; 

        include './config/connect_db.php'; 

        $sql = "UPDATE users SET email_verified_at = NOW() WHERE email = '{$email}' AND verification_code = '{$verification_code}'"; 
        $result = mysqli_query($connection, $sql); 

        if(mysqli_affected_rows($connection) == 0) {
            die('Verification failed');
        } 

        header("Location: ./login");
    }
?>

<main class="site-main">

    <!--Verify-->
    <section id="register">
        <div class="width-wrapper">
            <!--Form Container-->
            <div class="form-container">

                <!--Section Heading-->
                <h2 class="section-heading">Валидиране на имейл</h2>

                <!--Register Form-->
                <form action="<?php htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="POST" id="register-form">
                    <div>
                        <input type="hidden" name="email" value="<?php echo $_GET['email'] ?>">
                    </div>

                    <div>
                        <label for="verification_code">Код за валидация:</label>
                        <input type="text" name="verification_code" id="verification_code">
                    </div>

                    <input type="submit" id="submit-btn" value="Валидирай">
                </form>
            </div>

        </div>

    </section>
</main>