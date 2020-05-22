<?php

/**************
 * ROUTER
 *************/
session_start();
require_once("vendor/autoload.php");

// on récupère l'url
$url = $_SERVER["REQUEST_URI"];

// on récupère le path
$path = parse_url($url, PHP_URL_PATH);

// @list($null,$null,$null,$null, $controller, $action) = explode("/", $path);
@list($null, $controller, $action) = explode("/", $path);
$controller = !empty($controller) ? $controller : "main";
$action = $action ?? "index";


// on récupère les paramètres
$parameters = $_GET;


$dir = new DirectoryIterator(dirname(__FILE__).'/controllers');
require_once('./models/db.php');


  foreach ($dir as $fileinfo) {
    if (explode("C", $fileinfo->getFilename())[0] == $controller){
      require_once("controllers/".$controller."Controller.php");
      exit;
    }
  }

  require_once("controllers/error404.php");
