<?php
session_start();
//comeca sessao

$_SESSION = array();

session_destroy();
// destroi sessao

header("Location: /biblioteca/login.php");
//volta pra login.php
exit;
?>