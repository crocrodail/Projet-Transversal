<?php

if (isset($_POST['first_name']) && isset($_POST['last_name']) && isset($_POST['email']) && isset($_POST['birthday'])){
 require('../model/index.php');
register();

header("Location:../view/index2.html");
}
else{
    header("location:../view/index.html")
}
?>