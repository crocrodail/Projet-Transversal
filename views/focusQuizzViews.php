<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/../../public/assets/css/quizz_setup.css" class="css">
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <script src="https://kit.fontawesome.com/a660170305.js" crossorigin="anonymous"></script>
    <title>Document</title>
</head>

<body>
    <ul>
        <li><a href="../admin">Acceuil</a></li>
        <li><a href="../admin/quizz">Quizz</a></li>
    </ul>
    <div class="recherche">
        <div class="form-group has-search">
            <span class="fa fa-search form-control-feedback"></span>
            <input type="text" class="form-control" placeholder="Rechercher">
        </div>
    </div>
    <h1>Quizz</h1>
    <h2>Thème :</h2>
    <div class="theme">
        <p class="name"><?php echo $_GET['theme'] ?></p>
    </div>
    <?php
      $a = 0;
      foreach ($allQuestion as $key => $value) {
        $a++;
        echo '
        <div class="question">
            <h3>'.$a.'.Question</h3>
            <input type="text" name="Starfoullah" class="question_name text"
                value="'.$value['question'].'">
            <a href="../admin/deleteQuestion?id='.$value['id'].'&theme='.$_GET['theme'].'"><i class="fas fa-trash"></i></a>
            <h3>'.$a.'.Réponse</h3>
            <input type="text" name="Reponse" class="rep text" value="'.$value['response_1'].'">
            <input type="text" name="Reponse" class="rep text" value="'.$value['response_2'].'">
            <input type="text" name="Reponse" class="rep text" value="'.$value['response_3'].'">
            <input type="text" name="Reponse" class="rep text" value="'.$value['response_4'].'">
        </div>';
      }

    ?>
    <form class="question" method="POST" action="../admin/addQuestion?theme=<?php echo $_GET['theme'] ?>">
        <h3>Question</h3>
        <input type="text" name="question" class="question_name text" value="">
        <button type="submit"><i class="fas fa-plus"></i></button>
        <h3>Réponse</h3>
        <input type="text" name="r1" class="rep text" value="">
        <input type="text" name="r2" class="rep text" value="">
        <input type="text" name="r3" class="rep text" value="">
        <input type="text" name="r4" class="rep text" value="">
        <h3>Numéro de la bonne réponse</h3>
        <input type="text" name="correct" class="rep text" value="">
    </form>

    <div class="button">
    </div>


</body>

</html>
