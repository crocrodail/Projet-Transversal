<?php

function register() {
        $error == false;

    if (isset ($_POST ['last_name']) == false) {
        $error == true;
    }
    if (isset ($_POST ['first_name']) == false) {
        $error == true;
    }
    if (ctype_alpha($_POST['first_name']) == false) {
        $error == true;
    }
    if (ctype_alpha($_POST['last_name']) == false) {
        $error == true;
    }
    if (isset ($_POST ['email']) == false) {
        $error == true;
    }
    if (isset ($_POST ['birthday']) == false) {
        $error == true;
    }
    if (is_numeric($_POST['birthday']) == false){
        $error == true;
    }

    if($error == false){

    $last_name = $_POST["last_name"];
    $first_name = $_POST["first_name"];
    $mail = $_POST["email"];
    $birthday = $_POST["birthday"];
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);
    
    
        $dbco = new PDO('mysql:host=wr48466-001.dbaas.ovh.net:35458;dbname=Projet_transversal', 'invite', 'I2rQ9Bh2gzaD6t');
        $dbco->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
        $sth = $dbco->prepare("
            INSERT INTO users(first_name, last_name, email, birthday, password)
            VALUES(:first_name, :last_name, :email, :birthday, :password)");
        $sth->bindParam(':first_name',$first_name);
        $sth->bindParam(':last_name',$last_name);
        $sth->bindParam(':email',$mail);
        $sth->bindParam(':birthday',$birthday);
        $sth->bindParam(':password',$password);
        $sth->execute();
    
    

}
}
?>