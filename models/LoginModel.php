<?php

class connection{

  var $pseudo;
  var $first_name;
  var $last_name;
  var $email;

  function verifyConnection($data){
    if (isset($data['pseudo']) == false) {
        return "false";
    }
    if (isset($data['password']) == false) {
        return "false";
    }
    $pseudo = $data['pseudo'];
    $password = $data["password"];
    $dbh = new PDO('mysql:host=wr48466-001.dbaas.ovh.net:35458;dbname=Projet_transversal', 'invite', 'I2rQ9Bh2gzaD6t');
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $dbh->prepare("SELECT password FROM users WHERE pseudo=:pseudo");
    $stmt->execute(["pseudo" => $pseudo]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    if (isset($result)){
      echo var_dump($result)."<br>";
      $validPassword = password_verify($password, $result['password']);
      if ($validPassword){
        return "<h1>wellcome back ".$pseudo."</h1>";
      } else {
        return "<h1>wrong password</h1>";
      }

    } else {

      return "<h1>wrong pseudo</h1>";

    }
  }

  function generateSession(){

  }
}
