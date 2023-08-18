<?php 
/* deconnexion.php: est la page qui permet de déconnecter le client (détruire la session) et 
rediriger le navigateur vers la page login.php.
*/
   session_start();
   session_unset();
   session_destroy();
   header("location:login.php");
   exit;

?>
