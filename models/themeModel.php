<?php
require_once('models/db.php');

class theme{

  function getTheme(){

    $request = new connectSQL;
    $result = $request->fetch("SELECT name FROM `games_historic`");
    return $result;

  }

}
