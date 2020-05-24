<?php
require_once('models/db.php');

class question{

  function getAll(){
    $request = new connectSQL;
    $result = $request->fetch("SELECT *FROM `questions`WHERE theme_id = (SELECT id FROM themes WHERE themes.name = :theme)", ["theme" => $_GET["theme"]]);
    return $result;
  }

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

  function add($get, $post){
    if (isset($get) && isset($post)){
      $request = new connectSQL;
      $result = $request->execute(
        "INSERT INTO questions (`question`,`response_1`,`response_2`,`response_3`,`response_4`, `theme_id`, `corrected`)
        VALUES (
          :question, :r1, :r2, :r3, r4, (SELECT id FROM themes WHERE themes.name = :theme), :correct
        )",
        [
          "question" => $post['question'],
          "r1" => $post['r1'],
          "r2" => $post['r2'],
          "r3" => $post['r3'],
          "r4" => $post['r4'],
          "theme" => $get['theme'],
          "correct" => intval($post['correct']),
        ]);
    }
  }

  function remove($id){
    if(isset($id)){
      $request = new connectSQL;
      $result = $request->execute("DELETE FROM `questions` WHERE id = :id", ["id" => $id['id']]);
    }
  }

}
