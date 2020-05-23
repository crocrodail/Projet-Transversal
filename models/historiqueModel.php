<?php
require_once('models/db.php');

class historique{

  function get($data){
    if (isset($data['userId'])) {
      $request = new connectSQL;
      $result = $request->fetch("SELECT name, victory, score FROM `games_historic` INNER JOIN themes ON themes.id = games_historic.id_theme WHERE id_user = :userId ORDER BY games_historic.id_game DESC LIMIT 3",
        [
          "userId" => $data['userId']
        ]
      );
      return $result;
    } else {
      return 'no userId';
    }

  }

  function add($data){
    if (isset($data['user']) && isset($data['points']) && isset($data['victory']) && isset($data['theme']) && isset($data['score'])){
      $request = new connectSQL;
      if ($data['victory'] == "win" or $data['victory'] == "draw"){
        $data['victory'] = 1;
      } else {
        $data['victory'] = 0;
      }
      $updatePoint = $request->execute(
        "UPDATE users
        SET points = points + :points
        WHERE pseudo = :pseudo", ["pseudo" => $data['user'], "points" => $data['points']]);
      $result = $request->execute(
        "INSERT INTO games_historic
        (`id_user`, `victory`, `id_theme`, `score`)
        VALUES (
          (SELECT id FROM users WHERE pseudo = :user),
          :victory,
          (SELECT id FROM themes WHERE name = :theme),
          :result
        )",
        [
          "user" => $data['user'],
          "victory" => $data['victory'],
          "theme" => $data['theme'],
          "result" => $data['score']

        ]
      );
      return 'true';
    } else {
      return 'missing data';
    }
  }

}
