<?php
require_once('models/db.php');

class waitingLine{

  function getTheLast(){

    $request = new connectSQL;
    $result = $request->fetch("SELECT id_players, pseudo  FROM game_file_attente INNER JOIN users ON users.id = game_file_attente.id_players WHERE id = MAX(id)", );
    return $result;

  }


  function getDemande(){
    $request = new connectSQL;
    $result = $request->fetch("SELECT id_players, pseudo  FROM game_file_attente INNER JOIN users ON users.id = game_file_attente.id_players", );
    return $result;

  }


  function deleteListeAttente($userId){
    $request = new connectSQL;
    $result = $request->execute("DELETE FROM `game_file_attente` WHERE id = :userId",);
    [
        "userId" => $userId
    ]
    return $result;
  }


  function addToList($userId, $theme_choose){
    $request = new connectSQL;
    $request->execute(
      " INSERT INTO game_file_attente(id_players, theme_choose)
        VALUES(:id_player, :theme_choose)",
        [
          'id_player' => $userId,
          'theme_choose' => $theme_choose,
        ]);
    return "add to list";
  }

}