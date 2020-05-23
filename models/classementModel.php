<?php
require_once('models/db.php');

class classement{

  function getClassement(){

    $request = new connectSQL;
    $result = $request->fetch("SELECT id, points, pseudo, picture_profile FROM `users` ORDER BY points DESC", []);
    return $result;

  }

}
