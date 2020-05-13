<?php

require_once('./config/secret.php');


class connectSQL{
  function __construct(){
    try {
      $bdd = new PDO('mysql:dbname='.bdd()['dbname'].';host='.bdd()['host'], bdd()['username'], bdd()['password']);
    } catch (PDOException $e) {
      echo '<div class="errorSQL">';
      echo '<p>Connect Error -> ';
      echo $e->getMessage();
      echo '</p></div>';
      die;
    }
  }
  function fetch($request, $parameters){
    return $this->sqlRequest('fetch', $request, $parameters);
  }

  function execute($request, $parameters){
    return $this->sqlRequest('exec', $request, $parameters);
  }

  function sqlRequest($fetch, $request, $parameters){
    try {
      $dbh = new PDO('mysql:dbname='.bdd()['dbname'].';host='.bdd()['host'], bdd()['username'], bdd()['password']);
      $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $stmt = $dbh->prepare($request);
      $stmt->execute($parameters);
      // echo "<pre>";
      // $stmt->debugDumpParams();
      // echo "<pre>";
      if ($fetch != 'exec') {
        return $stmt->fetchall(PDO::FETCH_ASSOC);
      } else {
        return true;
      }
    }
    catch(Exception $e) {
      echo '<div class="errorSQL">';
      echo '<p>Exception -> ';
      echo $e->getMessage();
      echo '</p></div>';
      die;
    }
  }
}
