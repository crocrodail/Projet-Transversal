<?php
require_once('models/db.php');

class theme{

  function getTheme(){

    $request = new connectSQL;
    $result = $request->fetch("SELECT name FROM `themes`", []);
    return $result;

  }

}
