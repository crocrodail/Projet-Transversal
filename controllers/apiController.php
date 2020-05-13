<?php

  header("Access-Control-Allow-Origin: *");
  header("Content-Type: application/json; charset=UTF-8");
  header("Access-Control-Allow-Methods: POST");
  header("Access-Control-Max-Age: 3600");
  header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");


  switch ($action) {


    case 'register':

      http_response_code(200);
      require_once('models/RegisterModel.php');
      $register = new userRegister();
      $addUser = $register->register($_POST);
      echo json_encode($addUser);
      break;



    case 'login':

      http_response_code(200);
      require_once('models/LoginModel.php');
      $user = new connection();
      $connected = $user->verifyConnection($_POST);
      echo json_encode($connected);
      break;





    default:

      http_response_code(404);
      echo json_encode("error 404");
      break;
  }