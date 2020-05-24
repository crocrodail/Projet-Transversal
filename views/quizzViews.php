<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/../../public/assets/css/panel_quizz.css" class="css">
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <script src="https://kit.fontawesome.com/a660170305.js" crossorigin="anonymous"></script>
    <title>Document</title>
</head>

<body>
    <header>
        <ul>
            <li><a href="../admin">Acceuil</a></li>
            <li><a href="../admin/quizz">Quizz</a></li>
        </ul>
    </header>
    <div class="recherche">
        <div class="form-group has-search">
            <span class="fa fa-search form-control-feedback"></span>
            <input type="text" class="form-control" placeholder="Rechercher">
        </div>
    </div>
    <h1>Quizz</h1>
    <h2>Les thèmes :</h2>

    <?php
      foreach ($allThemes as $key => $value) {
        echo '<div class="thèmes">
                <p class="name">'.$value['name'].'</p>
                <a href="./quizz?theme='.$value["name"].'"><i class="fas fa-edit"></i></a>
              </div>';
      }
    ?>

</body>

</html>
