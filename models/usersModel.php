<?php
require_once('models/db.php');

class users {

  function getAll(){
    $request = new connectSQL;
    $result = $request->fetch("SELECT * FROM users", []);
    return $result;
  }

  function getOne($data){
    if (isset($data["userId"])){
      $request = new connectSQL;
      $result = $request->fetch("SELECT * FROM users WHERE id = :userId",
        [
          "userId" => $data['userId']
        ])[0];
      return $result;
    } else {
      return 'no userId';
    }
  }

  function changeData($userId, $data){
    if (isset($data) && isset($userId)){
      $request = new connectSQL;
      $result = $request->execute("UPDATE users SET pseudo = :pseudo, email= :email, points=:points, picture_profile=:pp WHERE id = :userId",
        [
          "userId" => $userId['user'],
          "pseudo" => $data['pseudo'],
          "email" => $data['email'],
          "points" => $data['points'],
          "pp" => $data['pp'],
        ]);
    }
  }
}
