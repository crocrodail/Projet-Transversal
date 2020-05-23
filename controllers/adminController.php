<?php
switch ($action) {
  case 'index':
    $users = new users();
    $allUsers = $users->getAll();
    include("views/panelViews.php");
    break;

  case 'focusPlayer':
    $users = new users();
    $myUser = $users->getOne($_GET);
    include("views/focusPlayerViews.php");
    break;

  default:
    include("views/error404.php");
    break;
}
