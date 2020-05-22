<?php
require_once('models/db.php');

class request{

  function sendInvite($data){
    if (isset($data['userId']) and isset($data['pseudo_invite'])){
      $request = new connectSQL;
      $speudo = $request->execute("
      INSERT INTO game_invitation (`id_invited_player`, `id_sender_player`)
      VALUES ((SELECT id FROM users WHERE pseudo = :pseudoReceiver), :idSender)",
       [
         "idSender" => $data['userId'],
         "pseudoReceiver" => $data['pseudo_invite']
       ]);
       return true;
    } else {
      return 'data not set';
    }
  }

  function getfriends($data){
    if (isset($data['userId'])){
      $request = new connectSQL;
      $speudo = $request->fetch("SELECT pseudo FROM users WHERE id = :userId", ["userId" => $data['userId']])[0];
      $result = $request->fetch("
      SELECT send.pseudo as pseudo1, recev.pseudo as pseudo2, send.picture_profile as url1 , recev.picture_profile as url2 FROM `friends`
      LEFT JOIN users as send ON send.id = friends.sender_id
      LEFT JOIN users as recev ON recev.id = friends.recever_id
      WHERE recever_id = :userId or sender_id = :userId
      ",
      [
          "userId" => $data['userId']
      ]);
      $a = 0;
      foreach ($result as $key => $value) {
        $a++;
        foreach ($value as $key => $v) {
          if ($value["pseudo1"] == $speudo["pseudo"]){
            $newResult[$a] = ["pseudo" => $value["pseudo2"], "url" =>$value["url2"]];
          } else {
            $newResult[$a] = ["pseudo" => $value["pseudo1"], "url" =>$value["url1"]];
          }
        }
      }
      return $newResult;
    }else{
      return "no userId";
    }
  }

  function getClassement($userId){

    $request = new connectSQL;
    $result = $request->fetch("SELECT sender_id, pseudo  FROM `friends` INNER JOIN users ON users.id = friends.sender_id WHERE recever_id = userId",
    [
        "userId" => $userId
    ]
);
    return $result;

  }

}
