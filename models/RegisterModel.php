<?php

class userRegister{

  function register($data) {

    $error = false;

    if (isset($data['pseudo']) == false) {
        $error = true;
    }
    if (isset($data['last_name']) == false) {
        $error = true;
    }
    if (isset($data['first_name']) == false) {
        $error = true;
    }
    if (ctype_alpha($data['first_name']) == false) {
        $error = true;
    }
    if (ctype_alpha($data['last_name']) == false) {
        $error = true;
    }
    if (isset($data['email']) == false) {
        $error = true;
    }
    if (isset($data['birthday']) == false) {
        $error = true;
    }

    if($error == false){
      try {

        $pseudo = $data["pseudo"];
        $last_name = $data["last_name"];
        $first_name = $data["first_name"];
        $mail = $data["email"];
        $birthday = $data["birthday"];
        $password = password_hash($data["password"], PASSWORD_DEFAULT);
        $dbco = new PDO('mysql:host=wr48466-001.dbaas.ovh.net:35458;dbname=Projet_transversal', 'invite', 'I2rQ9Bh2gzaD6t');
        $dbco->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sth = $dbco->prepare("
            INSERT INTO users(pseudo, first_name, last_name, email, birthday, password)
            VALUES(:pseudo, :first_name, :last_name, :email, :birthday, :password)");
        $sth->bindParam(':pseudo', $pseudo);
        $sth->bindParam(':first_name',$first_name);
        $sth->bindParam(':last_name',$last_name);
        $sth->bindParam(':email',$mail);
        $sth->bindParam(':birthday',$birthday);
        $sth->bindParam(':password',$password);
        $sth->execute();
        return "true";

      } catch (\Exception $e) {
        echo $e->getMessage();
        die;
        return "false";
      }

    } else {
      echo "eroor";
      return "false";

    }
  }
}
