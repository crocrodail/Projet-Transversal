<?php
require_once('models/db.php');

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

      $pseudo = $data["pseudo"];
      $last_name = $data["last_name"];
      $first_name = $data["first_name"];
      $mail = $data["email"];
      $birthday = $data["birthday"];
      $password = password_hash($data["password"], PASSWORD_DEFAULT);

      $request = new connectSQL;
      $request->execute(
        " INSERT INTO users(pseudo, first_name, last_name, email, birthday, password)
          VALUES(:pseudo, :first_name, :last_name, :email, :birthday, :password)",
          [
            'pseudo' => $pseudo,
            'first_name' => $first_name,
            'last_name' => $last_name,
            'email' => $mail,
            'pseudo' => $pseudo,
            'birthday' => $birthday,
            'password' => $password,
          ]);

      return true;


    } else {

      return false;

    }
  }
}
