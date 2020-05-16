<?php
require_once('models/db.php');

class deconnexion{

  function deconnexion(){

    session_destroy();
    if (session_destroy()){
      return "session detruite"
    } else {
      return "error"
    }


  }

}
