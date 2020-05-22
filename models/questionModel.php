<?php
require_once('models/db.php');

class question{

  function getQuestions($themeId){

    $request = new connectSQL;
    $result = $request->fetch("SELECT question, reponse_1, reponse2, reponse_3, reponse_4, corrected FROM `questions` ORDER BY RAND() LIMIT 10 WHERE theme_id = themeId" ,
    [
        "themeId" => $themeId;
    ]
);
    return $result;

  }

}
