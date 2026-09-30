<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Empréstimos — Biblioteca</title>
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
  $emprestimos = Emprestimo::listarTodos($conn);
  $livros      = Livro::listarTodos($conn);
  $alunos      = Aluno::listarTodos($conn);
  $msg         = $_GET['msg'] ?? '';

  // Índices para busca rápida
  $livrosIdx = [];
  foreach ($livros as $l) { $livrosIdx[$l->id] = $l->nome; }

  $alunosIdx = [];
  foreach ($alunos as $a) { $alunosIdx[$a->matricula] = $a->nome; }
  ?>

  
  <main class="main">
    <div class="topbar">
      <div>
        <div class="topbar-title">📋 Empréstimos</div>
        <div class="topbar-sub">Controle de empréstimos e devoluções</div>
      </div>
      <div class="topbar-actions">
        <a href="cadastrar.php" class="btn btn-primary">＋ Novo empréstimo</a>
      </div>
    </div>

    <div class="content">

      <?php if ($msg === 'cadastrado'): ?>
        <div class="alert alert-success">✓ Empréstimo registrado com sucesso!</div>
      <?php elseif ($msg === 'alterado'): ?>
        <div class="alert alert-success">✓ Empréstimo atualizado com sucesso!</div>
      <?php elseif ($msg === 'removido'): ?>
        <div class="alert alert-success">✓ Empréstimo removido com sucesso!</div>
      <?php endif; ?>

      <div class="table-header">
        <h2>Empréstimos: <?= count($emprestimos) ?></h2>
      </div>

      <div class="table-wrap">
        <table>
          <thead>
            <tr>
              <th>#</th>
              <th>Livro</th>
              <th>Aluno</th>
              <th>Matrícula</th>
              <th>Empréstimo</th>
              <th>Devolução</th>
              <th>Situação</th>
              <th>Ações</th>
            </tr>
          </thead>
          <tbody>

              <?php foreach ($emprestimos as $i => $emp): ?>
              <?php
                $nomeLivro = $livrosIdx[$emp->idLivro] ?? "Livro #{$emp->idLivro}";
                $nomeAluno = $alunosIdx[$emp->alunoMat] ?? "Matr. {$emp->alunoMat}";
                $atrasado  = $emp->dataDevolucao < date('Y-m-d');
              ?>
              <tr>
                <td class="td-mono"><?= $i + 1 ?></td>
                <td class="td-main"><?= htmlspecialchars($nomeLivro) ?></td>
                <td><?= htmlspecialchars($nomeAluno) ?></td>
                <td class="td-mono"><?= htmlspecialchars($emp->alunoMat) ?></td>
                <td><?= date('d/m/Y', strtotime($emp->dataEmprestimo)) ?></td>
                <td><?= date('d/m/Y', strtotime($emp->dataDevolucao)) ?></td>
                <td>
                  <span class="badge <?= $atrasado ? 'badge-late' : 'badge-ok' ?>">
                    <?= $atrasado ? '⚠ Atrasado' : '✓ No prazo' ?>
                  </span>
                </td>
                <td class="td-actions">
                  <a href="alterar.php?idx=<?= $i ?>" class="btn btn-sm btn-edit">Editar</a>
                  <a href="remover.php?idx=<?= $i ?>"
                     onclick="return confirm('Remover este empréstimo?')"
                     class="btn btn-sm btn-danger">Remover</a>
                </td>
              </tr>
              <?php endforeach; ?>

          </tbody>
        </table>
      </div>

    </div>
  </main>
</div>

</body>
</html>
