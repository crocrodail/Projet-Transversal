<?php
require_once('models/db.php');

class request{

  function getClassement($userId){

    $request = new connectSQL;
    $result = $request->fetch("SELECT sender_id, pseudo  FROM `friends` INNER JOIN users ON users.id = friends.sender_id WHERE recever_id = userId",
    [
        "userId" => $userId;
    ]
);
    return $result;

  }

}
