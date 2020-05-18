<?php
require_once('/models/db.php');

class classement{

  function getClassement(){

    $request = new connectSQL;
    $result = $request->fetch("SELECT points, pseudo FROM `users`");
    return $result;

  }

}
