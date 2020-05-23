<?php
  header("Access-Control-Allow-Origin: *");
  header("Access-Control-Allow-Headers: HASH, Content-Type");
  header("Content-Type: application/json; charset=UTF-8");
  header("Access-Control-Allow-Methods: POST");
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
      require_once('models/historiqueModel.php');
      $historique = new historique();
      $playersHistorique = $historique->get($data);
      echo json_encode($playersHistorique);
      break;

    case 'classement':

      http_response_code(200);
      require_once('models/classementModel.php');
      $classement = new classement();
      $globalClassement = $classement->getClassement();
      echo json_encode($globalClassement);
      break;

    case 'theme':

      http_response_code(200);
      require_once('models/themeModel.php');
      $theme = new theme();
      $allTheme = $theme->getTheme();
      echo json_encode($allTheme);
      break;

    case "getfriends":
      http_response_code(200);
      require_once('models/requestFriendsModel.php');
      $request = new request();
      $myRequest = $request->getfriends($data);
      echo json_encode($myRequest);
    break;

    case "sendInvite":
      http_response_code(200);
      require_once('models/requestFriendsModel.php');
      $request = new request();
      $myRequest = $request->sendInvite($data);
      echo json_encode($myRequest);
    break;

    case "addGame":
      http_response_code(200);
      require_once('models/historiqueModel.php');
      $historique = new historique();
      $myRequest = $historique->add($data);
      echo json_encode($myRequest);
    break;

    case 'friendsRequest':

      http_response_code(200);
      require_once('models/requestFriendsModel.php');
      $request = new request();
      $myRequest = $myRequest->getRequest($_SESSION["id"]);
      echo json_encode($myRequest);
      break;


    case 'getQuestions':

      http_response_code(200);
      require_once('models/questionModel.php');
      $question = new question();
      $tenQuestions = $question->getQuestions($data);
      echo json_encode($tenQuestions);
      break;


    case 'fileAttente':

      http_response_code(200);
      require_once('models/fileAttenteModel.php');
      $waitingLine = new waitingLine();
      $theOlder = $waitingLine->getTheLast();
      echo json_encode($theOlder);
      break;


    case 'invited':

      http_response_code(200);
      require_once('models/fileAttenteModel.php');
      $demande = new waitingLine();
      $demandeJeu = $demande->getDemande($data);
      echo json_encode($demandeJeu);
      break;


    case 'retirezDeLaListeAttente':

      http_response_code(200);
      require_once('models/fileAttenteModel.php');
      $deletePlayer = new deletePlayerFromWaitList();
      $rmFromWaiting = $deletePlayer->deleteListeAttente($_SESSION["id"]);
      echo json_encode($rmFromWaiting);
      break;

    case 'ajoutezALaListe':

      http_response_code(200);
      require_once('models/fileAttenteModel.php');
      $addPlayer = new addPlayerToWaitList();
      $addToWaiting = $addPlayer->addToList($_SESSION["id"], $data[id_theme]);
      echo json_encode($addToWaiting);
      break;

    case 'getMyInfo':
      http_response_code(200);
      require_once('models/usersModel.php');
      $demande = new users();
      $info = $demande->getOne($data);
      echo json_encode($info);
      break;


    default:

      http_response_code(404);
      echo json_encode("error 404");
      break;
  }

exit;
