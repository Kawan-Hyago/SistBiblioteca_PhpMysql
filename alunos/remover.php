<?php
  require_once '../includes/auth.php';
  require_once '../includes/funcoes.php';
  require_once '../models/aluno.php';
  require_once '../includes/conexaobd.php';



//puxa o arquivo

$matRemover = isset($_GET['matricula']) ? trim($_GET['matricula']) : '';

if ($matRemover === '') {
    header('Location: listar.php');
    exit;
}

$alunoRem = Aluno::findByMatricula($conn, $matRemover);
if($alunoRem !== null){$alunoRem->remover($conn);
header('Location: listar.php?msg=removido');
exit;
}








 // $indice = trim($_POST['excluir']);
  //$qual = trim($_POST['valor']);
 // $aluno = Aluno::findByMatricula($qual);
  //$aluno->remover($conn);
  ?>
