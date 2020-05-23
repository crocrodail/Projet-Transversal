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
}
