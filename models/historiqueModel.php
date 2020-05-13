<?php
require_once('models/db.php');

class historique{

  function get($userId){

    $request = new connectSQL;
    $result = $request->fetch("SELECT name, victory, score FROM `games_historic` INNER JOIN themes ON themes.id = games_historic.id_theme WHERE id_user = :userId",
      [
        "userId" => $userId
      ]
    );
    return $result;

  }

}
