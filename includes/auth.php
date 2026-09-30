<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
//verifica se ja tem uma sessão

if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit();
}
//verifica se ja logou um usuario, se não retorna pro logim