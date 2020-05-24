<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/../../public/assets/css/info_panel.css" class="css">
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
    <div class="title">
        <h1>Informations personnelles</h1>
        <img src="<?php echo $myUser['picture_profile'] ?>" class="img">
    </div>
    <form id="info" class="info" method="POST" action="../admin/saveData?user=<?php echo $myUser['id'] ?>">
        <div class="info_1">
            <div class="name">
                <p>Prénom:</p>
                <input type="text" class="form" value="null">
            </div>
            <div class="name">
                <p>Nom:</p>
                <input type="text" class="form" value="null">
            </div>
            <div class="name">
                <p>Point:</p>
                <input name="points" type="text" class="form" value="<?php echo $myUser['points'] ?>">
            </div>
        </div>
        <div class="info_2">
            <div class="name">
                <p>Image de profil:</p>
                <input name="pp" type="text" class="form" value="<?php echo $myUser['picture_profile'] ?>">
            </div>
            <div class="name">
                <p>Email:</p>
                <input name="email" type="mail" class="form" value="<?php echo $myUser['email'] ?>">
            </div>
            <div class="name">
                <p>Pseudo:</p>
                <input name="pseudo" type="text" class="form" value="<?php echo $myUser['pseudo'] ?>">
            </div>
        </div>
    </form>
    <div class="button">
        <input type="submit" form="info" value="Enregistrer les informations" class="save">
        <a href="#"><input type="reset" value="Annuler" class="cancel"></a>
    </div>
</body>

</html>
