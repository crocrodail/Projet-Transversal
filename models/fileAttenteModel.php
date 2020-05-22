<?php
require_once('models/db.php');

class waitingLine{

  function getTheLast(){

    $request = new connectSQL;
    $result = $request->fetch("SELECT id_players, pseudo  FROM game_file_attente INNER JOIN users ON users.id = game_file_attente.id_players WHERE id = MAX(id)", );
    return $result;

  }


  function getDemande($data){
    if (isset($data['userId'])){
      $request = new connectSQL;
      $result = $request->fetch("SELECT * FROM game_invitation INNER JOIN users ON users.id = game_invitation.id_sender_player WHERE id_invited_player = :userId",
        [
          "userId" => $data['userId']
        ]);
      $request->execute("DELETE FROM `game_invitation` WHERE id_invited_player = :userId order by id_sender_player desc limit 1",
      [
        "userId" => $data['userId']
      ]);
      return $result;
    } else {
      return "no userId";
    }

  }


  function deleteListeAttente($userId){
    $request = new connectSQL;
    $result = $request->execute("DELETE FROM `game_file_attente` WHERE id = :userId",
    [
        "userId" => $userId
    ]);
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
