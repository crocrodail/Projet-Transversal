<?php

require_once('models/db.php');

class connection{


  function changeUsers($photo ="", $email="", $pseudo="", $id){

    if(isset($id["id"]){
      $request = new connectSQL;
      $verif = $request->fetch("SELECT email, picture_profile, pseudo FROM `users` WHERE id = usersId" ,
      [
          "usersId" => $id
      ]
    );

    function verif($photo=$verif["picture_profile"], $email=$verif["email"], $pseudo=$verif["pseudo"] , $id){
      $request = new connectSQL;
      $result = $request->execute("INSERT INTO users(pseudo, email, picture_profile) VALUES(:pseudo, :email, :password, picture_profile)", ,
      [
          "pseudo" => $pseudo,
          "emaiil" => $email,
          "password" => $password,
          "picture_profile" => $photo,
      ]
    );
    }

      };
    )};

return "c fait"


};
