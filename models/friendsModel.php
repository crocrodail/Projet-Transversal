<?php
require_once('models/db.php');

class friends{

  function addFriends($userId, $receverId){

    $request = new connectSQL;
    $request->execute(
      " INSERT INTO friends(sender_id, recever_id, status)
        VALUES(:userId, :recever_id, "en attente")",
        [
          'userId' => $userId,
          'recever_id' => $receverId,
        ]);

    );
    return "demande envoyer";

  }


  function get($userId, $receverId){

    $request = new connectSQL;
    $request->execute(
      " INSERT INTO friends(status)
        VALUES("Amis")
        WHERE sender_id = :userId AND recever_id = :recever_id",

        [
          'userId' => $userId,
          'recever_id' => $receverId,
        ]);

    );
    return "Nouvel Amis !!";

  }


}
