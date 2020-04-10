<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
  <?php if (error != ""){echo $error;};?>
    <form action="../users/register" method="POST">
        <input type="text" name="pseudo" placeholder="pseudo" required><br>
        <input type="text" name="first_name" placeholder="first name" required><br>
        <input type="text" name="last_name" placeholder="last name" required><br>
        <input type="mail" name="email" placeholder="Email" required><br>
        <label>birthday</label><br>
        <input type="date" name="birthday" required><br>
        <input type="password" name="password" placeholder="Password"><br>
        <button>envoyer</button>
    </form>
</body>
</html>
