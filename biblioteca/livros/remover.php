<?php
require_once '../includes/auth.php';
require_once '../includes/funcoes.php';
require_once '../includes/conexaobd.php';
require_once '../models/livro.php';
//puxa o arquivo

$idRemover = isset($_GET['id']) ? trim($_GET['id']) : '';
if ($idRemover === '') {
    header('Location: listar.php');
    exit;
}

$livroRem= Livro::findById($conn, $idRemover);
if($livroRem !== null){
    $livroRem->remover($conn);
    header('Location: listar.php?msg=removido');
exit;
}
