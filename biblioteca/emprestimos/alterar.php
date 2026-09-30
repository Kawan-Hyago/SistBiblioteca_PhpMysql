<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Editar Empréstimo — Biblioteca</title>
  <link rel="stylesheet" href="../assets/style.css">
</head>
<body>

  <?php
  require_once '../includes/auth.php';
  require_once '../includes/funcoes.php';
  require_once '../includes/navbar.php';
  require_once '../includes/conexaobd.php';
  require_once '../models/emprestimo.php';
  require_once '../models/livro.php';
  require_once '../models/aluno.php';
  $idx         = (int)($_GET['idx'] ?? -1);
  $emprestimos = Emprestimo::listarTodos($conn);
  $livros      = Livro::listarTodos($conn);
  $alunos      = Aluno::listarTodos($conn);

  $emp = Emprestimo::findById($conn, $idx+1);

  if ($idx < 0 || !isset($emprestimos[$idx])) {
      header('Location: listar.php'); exit;
  }
 
  $erro = '';

  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $idLivro        = trim($_POST['idLivro']);
      $alunoMat      = trim($_POST['matricula']);
      $dataEmprestimo = trim($_POST['dataEmprestimo']);
      $dataDevolucao  = trim($_POST['dataDevolucao']);

      if (!$idLivro || !$alunoMat || !$dataEmprestimo || !$dataDevolucao) {
          $erro = 'Preencha todos os campos.';
      } elseif ($dataDevolucao <= $dataEmprestimo) {
          $erro = 'A data de devolução deve ser posterior à data do empréstimo.';
      } else {
          //$emprestimos[$idx] = [$idLivro, $matricula, $dataEmprestimo, $dataDevolucao];

          $emprestimo = new Emprestimo($idLivro, $alunoMat, $dataEmprestimo, $dataDevolucao);
          $emprestimo->alterar($conn, $idx+1);


          
          header('Location: listar.php?msg=alterado'); exit;
      }
  }
  $dados = [
    'idLivro'        => $_POST['idLivro']        ?? $emp->idLivro,
    'matricula'      => $_POST['matricula']      ?? $emp->alunoMat,
    'dataEmprestimo' => $_POST['dataEmprestimo'] ?? $emp->dataEmprestimo,
    'dataDevolucao'  => $_POST['dataDevolucao']  ?? $emp->dataDevolucao,
];
  ?>

  <main class="main">
    <div class="topbar">
      <div>
        <div class="topbar-title">✏️ Editar Empréstimo</div>
        <div class="topbar-sub">Registro nº <?= $idx + 1 ?></div>
      </div>
      <div class="topbar-actions">
        <a href="listar.php" class="btn btn-ghost">← Voltar</a>
      </div>
    </div>

    <div class="content">

      <?php if ($erro): ?>
        <div class="alert alert-error">⚠ <?= htmlspecialchars($erro) ?></div>
      <?php endif; ?>

      <form action="alterar.php?idx=<?= $idx ?>" method="POST">
        <div class="form-card">

          <div class="form-row">
            <div class="form-group">
              <label for="idLivro">Livro *</label>
              <select id="idLivro" name="idLivro" required>
                <option value="">Selecione um livro</option>
                <?php foreach ($livros as $livro): ?>
                  <option value="<?= $livro->id ?>" 
                    <?= ($dados['idLivro'] == $livro->id) ? 'selected' : '' ?>>
                    <?= htmlspecialchars("{$livro->id} – {$livro->nome}") ?>
                  </option>
                <?php endforeach; ?>
              </select>
            </div>
            <div class="form-group">
              <label for="matricula">Aluno *</label>
              <select id="matricula" name="matricula" required>
                <option value="">Selecione um aluno</option>
                <?php foreach ($alunos as $aluno): ?>
                  <option value="<?= $aluno->matricula ?>" 
                    <?= ($dados['matricula'] === $aluno->matricula) ? 'selected' : '' ?>>
                    <?= htmlspecialchars("{$aluno->nome} ({$aluno->matricula})") ?>
                  </option>
                <?php endforeach; ?>
              </select>
            </div>
          </div>

          <div class="form-row">
            <div class="form-group">
              <label for="dataEmprestimo">Data do empréstimo *</label>
              <input type="date" id="dataEmprestimo" name="dataEmprestimo"
                value="<?= htmlspecialchars($dados['dataEmprestimo']) ?>">
            </div>
            <div class="form-group">
              <label for="dataDevolucao">Data de devolução *</label>
              <input type="date" id="dataDevolucao" name="dataDevolucao"
                value="<?= htmlspecialchars($dados['dataDevolucao']) ?>">
            </div>
          </div>

          <div class="form-actions">
            <button type="submit" class="btn btn-primary">Salvar alterações</button>
            <a href="listar.php" class="btn btn-ghost">Cancelar</a>
          </div>

        </div>
      </form>

    </div>
  </main>
</div>

</body>
</html>