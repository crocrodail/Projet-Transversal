<?php

  header("Access-Control-Allow-Origin: *");
  header("Content-Type: application/json; charset=UTF-8");
  header("Access-Control-Allow-Methods: POST");
  header("Access-Control-Max-Age: 3600");
  header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
  $json = file_get_contents("php://input");
  $data = json_decode($json, true);

  switch ($action) {


    case 'register':

      http_response_code(200);
      require_once('models/RegisterModel.php');
      $register = new userRegister();
      $addUser = $register->register($data);
      echo json_encode($addUser);
      break;



    case 'login':

      http_response_code(200);
      require_once('models/LoginModel.php');
      $user = new connection();
      $connected = $user->verifyConnection($data);
      echo json_encode($connected);
      break;


    case 'historique':
    
      http_response_code(200);
      if (isset($_SESSION["id"])){
        require_once('models/historiqueModel.php');
        $historique = new historique();
        $playersHistorique = $historique->get($_SESSION["id"]);
        echo json_encode($playersHistorique);
      } else {
        echo json_encode("disconected");
      }
      break;




    default:

      http_response_code(404);
      echo json_encode("error 404");
      break;
  }
