<?php include "../model/db.php";?>
 
<?php
    session_start();
    session_destroy();
    header("Location:../view/login.php");

?>