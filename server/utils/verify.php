<?php 
function verifyUser(){

    if(isset($_POST["g-recaptcha-response"])){
        include './config/secret.php'; 
        $ip = $_SERVER["REMOTE_ADDR"]; 
        $response = $_POST["g-recaptcha-response"];
        $url = "https://www.google.com/recaptcha/api/siteverify?secret=$secret_key&response=$response&remoteip=$ip"; 
        $fire = file_get_contents($url); 
        $data = json_decode($fire);

        if($data->success == true){
            return true;
        } else {
            return false;
        }
    } else {
        echo "Recapthca Error";
        return false;
    } 
}
?>