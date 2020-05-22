<?php

require_once('models/db.php');

class connection{

  var $pseudo;
  var $first_name;
  var $last_name;
  var $email;

  function verifyConnection($data){

    if (isset($data['email']) == false) {
        return "no email";
    }
    if (isset($data['password']) == false) {
        return "no password";
    }

    $email = $data['email'];
    $password = $data["password"];

    $request = new connectSQL;
    $result = $request->fetch("SELECT * FROM users WHERE email=:email", ["email" => $email])[0];
    if (isset($result)){
      $validPassword = password_verify($password, $result['password']);

      if ($validPassword){
        return $result;
      } else {
        return "wrong password";
      }

    } else {

      return false;

    }
  }

  function generateSession(){

  }
}
