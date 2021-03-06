<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/../../public/assets/css/panel-acceuil.css" class="css">
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <script src="https://kit.fontawesome.com/a660170305.js" crossorigin="anonymous"></script>
    <title>Document</title>
</head>

<body>
    <header>
        <ul>
            <li><a href="./admin">Acceuil</a></li>
            <li><a href="./admin/quizz">Quizz</a></li>
        </ul>
    </header>
    <div class="recherche">
        <div class="form-group has-search">
            <span class="fa fa-search form-control-feedback"></span>
            <input type="text" class="form-control" placeholder="Rechercher">
        </div>
    </div>
    <div class="information">
        <div class="count">
            <p class="title">Nombre de comptes créés depuis le lancement</p>
            <p class="number"><img class="icone" src="/../../public/assets/img/panel/peuple.svg"><?php echo count($allUsers) ?></p>
        </div>
        <div class="actif">
            <p class="title">Nombre de comptes actifs les 30 derniers jours</p>
            <p class="number"><img class="icone" src="/../../public/assets/img/panel/peuple.svg"><?php echo count($allUsers) ?></p>
        </div>
        <div class="news">
            <p class="title">Nombre de nouveaux comptes les 30 derniers jours</p>
            <p class="number"><img class="icone" src="/../../public/assets/img/panel/peuple.svg"><?php echo count($allUsers) ?></p>
        </div>
    </div>

    <h2>Pseudo</h2>


    <?php
      foreach ($allUsers as $key => $value) {
        echo '<div class="account">
                <p class="pseudo">'. $value['pseudo'] .'</p>
                <a href="./admin/focusPlayer?userId='.$value["id"].'"><i class="fas fa-edit"></i></a>
              </div>';
      }
    ?>

</body>

</html>
