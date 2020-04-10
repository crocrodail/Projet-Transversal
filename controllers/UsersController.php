<?php


  if($action == "register"){

    $error = "";

    if (isset($_POST['first_name']) && isset($_POST['last_name']) && isset($_POST['email']) && isset($_POST['birthday'])){

      require_once('models/RegisterModel.php');
      $register = new userRegister();
      $addUser = $register->register($_POST);
      header("Location: /users/register?error=".$addUser);
      exit;

    } elseif (isset($_GET['error'])){

      if ($_GET['error'] == "true"){
        $error = "<h1>Vous etes bien enregistrer !</h1>";
      } else {
        $error = "<h1>Une erreur est survenue !</h1>";
      }

    }

    include("views/RegisterView.php");

  }elseif ($action == "login"){

    require_once('models/LoginModel.php');

    if (isset($_POST['pseudo']) && isset($_POST['password'])){

      $user = new connection();
      $connected = $user->verifyConnection($_POST);


      if ($connected == "true"){
        //$user->generateSession();
      }else{

      }


    }


    include("views/loginView.php");

  }
