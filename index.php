<?php
session_start();

/**************
 * ROUTER
 *************/

// on récupère l'url
$url = $_SERVER["REQUEST_URI"];

// on récupère le path
$path = parse_url($url, PHP_URL_PATH);
// /recette/index

@list($null, $controller, $action) = explode("/", $path);
            // recette    //index
$controller = !empty($controller) ? $controller : "main";
$action = $action ?? "index";

// on récupère les paramètres
$parameters = $_GET;
require_once('config/secret.php');
require_once('models/RegisterModel.php');



if($controller == "users"){
  require_once("controllers/UserController.php");
}
