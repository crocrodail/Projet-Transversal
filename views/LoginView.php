<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>

    <?php if(isset($connected)){echo $connected;}; ?>

    <form action="../users/login" method="post">
      <input type="text" placeholder="pseudo" name="pseudo" value="">
      <input type="password" placeholder="password" name="password" value="">
      <input type="submit" name="" value="login">
    </form>

  </body>
</html>
