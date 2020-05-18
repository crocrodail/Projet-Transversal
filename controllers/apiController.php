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

    case 'classement':

      http_response_code(200);
      if (isset($_SESSION["id"])){
        require_once('models/classementModel.php');
        $classement = new classement();
        $globalClassement = $classement->getClassement();
        echo json_encode($globalClassement);
      }else {
        echo json_encode("disconected");
      }
      break;

    case 'theme':

      http_response_code(200);
      if (isset($_SESSION["id"])){
        require_once('models/themeModel.php');
        $theme = new theme();
        $allTheme = $theme->getTheme();
        echo json_encode($allTheme);
      } else {
        echo json_encode("disconected");
      }
      break;


    case 'friendsRequest':

      http_response_code(200);
      if (isset($_SESSION["id"])){
        require_once('models/requestFriendsModel.php');
        $request = new request();
        $myRequest = $myRequest->getRequest($_SESSION["id"]);
        echo json_encode($myRequest);
      } else {
        echo json_encode("disconected");
      }
      break;


    case 'questions':

      http_response_code(200);
      if (isset($_SESSION["id"])){
        require_once('models/questionModel.php');
        $question = new question();
        $tenQuestions = $question->getQuestions($data["themeId"]);
        echo json_encode($tenQuestions);
      } else {
        echo json_encode("disconected");
      }
      break;


    case 'fileAttente':

      http_response_code(200);
      if (isset($_SESSION["id"])){
        require_once('models/fileAttenteModel.php');
        $waitingLine = new waitingLine();
        $theOlder = $waitingLine->getTheLast();
        echo json_encode($theOlder);
      } else {
        echo json_encode("disconected");
      }
      break;


    case 'demandePourJouer':

      http_response_code(200);
      if (isset($_SESSION["id"])){
        require_once('models/fileAttenteModel.php');
        $demande = new demande();
        $demandeJeu = $demande->getDemande();
        echo json_encode($demandeJeu);
      } else {
        echo json_encode("disconected");
      }
      break;


    case 'retirezDeLaListeAttente':

      http_response_code(200);
      if (isset($_SESSION["id"])){
        require_once('models/fileAttenteModel.php');
        $deletePlayer = new deletePlayerFromWaitList();
        $rmFromWaiting = $deletePlayer->deleteListeAttente($_SESSION["id"]);
        echo json_encode($rmFromWaiting);
      } else {
        echo json_encode("disconected");
      }
      break;

    case 'ajoutezALaListe':

      http_response_code(200);
      if (isset($_SESSION["id"])){
        require_once('models/fileAttenteModel.php');
        $addPlayer = new addPlayerToWaitList();
        $addToWaiting = $addPlayer->addToList($_SESSION["id"], $data[id_theme]);
        echo json_encode($addToWaiting);
      } else {
        echo json_encode("disconected");
      }
      break;


    case 'deconexion':

      http_response_code(200);
      if (isset($_SESSION["id"])){
        require_once('models/deconexionModel.php');
        $deconect = new deconnexion();
        $deconnexion = $deconect->deconnexion();
        echo json_encode($deconnexion);
      } else {
        echo json_encode("error");
      }
      break;




    default:

      http_response_code(404);
      echo json_encode("error 404");
      break;
  }
