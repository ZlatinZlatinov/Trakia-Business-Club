<!--
YouTube: https://youtu.be/fSfNTACbplA?si=fY3DRv9inV1qmQGi Credits: Digital Fox
         https://youtu.be/QQUNOcy_i6A?si=NeRgGWmBRIKzNmsj Credits: Adnan Afzal
-->

<?php
$mail_key = "your-mail-key-16-chars";

// Define the Gmail's smtp mail server
define('MAILHOST', "smtp.gmail.com");

//Define as a username the email that you use in your Gmail account. 
define("USERNAME", "your-email-goes-here");

//Define your 16 digit Gmail app-password. 
define('PASSWORD', $mail_key);

//Define the email addres from which the email is sent. 
define('SEND_FROM', "your-email-goes-here");

//Define the name of the website from which the email is sent. 
define('SEND_FROM_NAME', 'your-name-goes-here');

//Define reply-to address.
define('REPLY_TO', "your-email-goes-here");

//Define the reply-to name.
define('REPLY_TO_NAME', 'your-name-goes-here');
