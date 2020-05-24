<?php
switch ($action) {
  case 'index':
    require_once('models/usersModel.php');
    $users = new users();
    $allUsers = $users->getAll();
    include("views/panelViews.php");
    break;

  case 'focusPlayer':
    require_once('models/usersModel.php');
    $users = new users();
    $myUser = $users->getOne($_GET);
    include("views/focusPlayerViews.php");
    break;

    case 'quizz':
      if (isset($_GET["theme"])){
        require_once('models/questionModel.php');
        $question = new question();
        $allQuestion = $question->getAll();
        include("views/focusQuizzViews.php");
      } else {
        require_once('models/themeModel.php');
        $theme = new theme();
        $allThemes = $theme->getTheme();
        include("views/quizzViews.php");
      }
      break;

    case 'saveData':
      require_once('models/usersModel.php');
      $users = new users();
      $myUser = $users->changeData($_GET, $_POST);
      header('Location: ../admin/focusPlayer?userId='.$_GET['user']);
      exit();
      break;

    case 'addQuestion':
      require_once('models/questionModel.php');
      $question = new question();
      $allQuestion = $question->add($_GET, $_POST);
      header('Location: ../admin/quizz?theme='.$_GET['theme']);
      exit();
      break;

    case 'deleteQuestion':
      require_once('models/questionModel.php');
      $question = new question();
      $allQuestion = $question->remove($_GET);
      header('Location: ../admin/quizz?theme='.$_GET['theme']);
      exit();
      break;

  default:
    include("views/error404.php");
    break;
}
