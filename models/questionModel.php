<?php
require_once('models/db.php');

class question{

  function getQuestions($data){
    if (isset($data["theme"])){
      $request = new connectSQL;
      $result = $request->fetch(
        "SELECT *
        FROM `questions`
        WHERE theme_id = (SELECT id FROM themes WHERE themes.name = :theme)
        ORDER BY RAND()
        LIMIT 10",
      [
          "theme" => $data["theme"]
      ]
  );
      return $result;
    } else {
      return "no theme";
    }

  }

}
