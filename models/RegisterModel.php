<?php
require_once('models/db.php');

class userRegister{

  function register($data) {

    $error = false;

    if (isset($data['pseudo']) == false) {
        $error = true;
    }
    if (isset($data['email']) == false) {
        $error = true;
    }
    if (isset($data['password']) == false) {
        $error = true;
    }

    if($error == false){

      $pseudo = $data["pseudo"];
      $mail = $data["email"];
      $password = password_hash($data["password"], PASSWORD_DEFAULT);

      $request = new connectSQL;
      $request->execute(
        " INSERT INTO users(pseudo, email, password)
          VALUES(:pseudo, :email, :password)",
          [
            'pseudo' => $pseudo,
            'email' => $mail,
            'password' => $password,
          ]);

      return true;


    } else {

      return false;

    }
  }
}
