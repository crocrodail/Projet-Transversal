<?php
session_start();

/**************
 * ROUTER
 *************/

// on récupère l'url
$url = $_SERVER["REQUEST_URI"];

// on récupère le path
$path = parse_url($url, PHP_URL_PATH);

@list($null, $controller, $action) = explode("/", $path);
$controller = !empty($controller) ? $controller : "main";
$action = $action ?? "index";


// on récupère les paramètres
$parameters = $_GET;


$dir = new DirectoryIterator(dirname(__FILE__).'/controllers');

if($controller == "main"){

  require_once("controllers/UserController.php");

} else {

  foreach ($dir as $fileinfo) {
    if (explode("C", $fileinfo->getFilename())[0] == $controller){
      require_once("controllers/".$controller."Controller.php");
      exit;
    }
  }

  require_once("controllers/error404.php");

}
