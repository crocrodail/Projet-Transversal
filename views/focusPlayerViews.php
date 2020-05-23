<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="public/assets/css/info_panel.css" class="css">
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <script src="https://kit.fontawesome.com/a660170305.js" crossorigin="anonymous"></script>
    <title>Document</title>
</head>

<body>
    <header>
        <ul>
            <li><a href="#">Acceuil</a></li>
            <li><a href="#">Quizz</a></li>
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
        <div class="img"></div>
    </div>
    <div class="info">
        <div class="info_1">
            <div class="name">
                <p>Prénom:</p>
                <input type="text" class="form">
            </div>
            <div class="name">
                <p>Nom:</p>
                <input type="text" class="form">
            </div>
            <div class="name">
                <p>Point:</p>
                <input type="text" class="form">
            </div>
        </div>
        <div class="info_2">
            <div class="name">
                <p>Email:</p>
                <input type="mail" class="form">
            </div>
            <div class="name">
                <p>Mot de passe:</p>
                <input type="password" class="form">
            </div>
            <div class="name">
                <p>Pseudo:</p>
                <input type="text" class="form">
            </div>
        </div>
    </div>
    <div class="button">
        <input type="button" value="Enregistrer les informations" class="save">
        <input type="button" value="Voir ses amis" class="friends">
        <input type="button" value="Annuler" class="cancel">
    </div>
</body>

</html>