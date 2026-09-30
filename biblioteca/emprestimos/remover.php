<?php
    require_once '../includes/auth.php';
    require_once '../includes/funcoes.php';
    require_once '../includes/conexaobd.php';
  require_once '../models/emprestimo.php';

    //puxa o arquivo

    $idx = isset($_GET['idx']) ? (int)$_GET['idx'] : -1;
    //  Se o campo existir, ele pega o valor e o transforma obrigatoriamente em um número inteiro;Se o campo não existir na URL, ele define o valor padrão como -1
    $emprestimos =Emprestimo::listarTodos
    //guarda o que estiver no arquivo emprestimos.php em $emprestimos

    $empRem= Emprestimo::findById($conn, $idx+1);
    if($idx>=0){
        if($empRem !== null ){
        $empRem->remover($conn,$idx+1);
        header('Location: listar.php?msg=removido');

    }
    }
