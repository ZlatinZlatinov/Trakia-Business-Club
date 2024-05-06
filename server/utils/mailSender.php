<?php 
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP; 
    use PHPMailer\PHPMailer\Exception; 

    require './PHPMailer/PHPMailer-master/src/Exception.php'; 
    require './PHPMailer/PHPMailer-master/src/PHPMailer.php'; 
    require './PHPMailer/PHPMailer-master/src/SMTP.php'; 

    require './config/mailConfig.php'; 

    /*
        email - where the email goes
        subject - the subject of the email
        message - the message of the email 
        returns string / error message
    */

    function sendEmail($email, $subject, $message){
        // Creating a new PHPMailer object
        $mail = new PHPMailer(true); 

        // Using the SMTP Protocol to send email
        $mail->isSMTP(); 

        //Set the SMTPAUTH property to true, so we can use
        // our Gmail login details to send the email
        $mail->SMTPAuth = true; 

        //Setting the Host property to the Mailhost value from config file
        $mail->Host = MAILHOST; 

        //Setting the property to the username form configure constants
        $mail->Username = USERNAME; 

        //Setting the password
        $mail->Password = PASSWORD; 

        /*This will tell to start TTLS encryption */
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; 

        //Set the mail port
        $mail->Port = 587; 

        $mail->setFrom(SEND_FROM, SEND_FROM_NAME); 
        
        //Specify where the email goes
        $mail->addAddress($email); 

        /*
        Might add 'addReplyTo' to specify where the recipient can reply to
        $mail->addReplyTo(REPLY_TO, REPLY_TO_NAME);
        */ 

        /*Tell the phpMailer that we will include php markup in our message */
        $mail->isHTML(true); 
        
        // assing the incoming subject
        $mail->Subject = $subject; 

        // assign a message
        $mail->Body = $message; 
        $mail->AltBody = $message;

        try{
            if(!$mail->send()){
                // message sending failed
                return false;
            } else {
                // succesful sending
                return true;
            }
        } catch(Exception $e){
           echo $e->errorMessage();
        }

    }
?>