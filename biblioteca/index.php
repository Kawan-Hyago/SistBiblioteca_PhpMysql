<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Painel — Biblioteca</title>
  <link rel="stylesheet" href="assets/style.css">
</head>
<body>

<?php
require_once 'includes/auth.php';
require_once 'includes/funcoes.php';
require_once 'includes/navbar.php';
require_once 'includes/conexaobd.php';
  require_once 'models/emprestimo.php';
  require_once 'models/livro.php';
  require_once 'models/aluno.php';

$emprestimos = Emprestimo::listarTodos($conn);
  $livros      = Livro::listarTodos($conn);
  $alunos      = Aluno::listarTodos($conn);

$livros = is_array($livros) ? $livros : [];
$alunos = is_array($alunos) ? $alunos : [];
$emprestimos = is_array($emprestimos) ? $emprestimos : [];

$hoje = strtotime(date('Y-m-d'));
$atrasados = 0;

if (is_array($emprestimos)) {
  foreach ($emprestimos as $emp) {

    if (!isset($emp)) continue;

    $dataRaw = trim($emp->dataDevolucao ?? '');

    if ($dataRaw === '') continue;

    $data = strtotime($dataRaw);

    if ($data !== false && $data < $hoje) {
      $atrasados++;
    }
  }
}
?>

<!-- ════════════════════════════ MAIN ════════════════════════════ -->
<main class="main">
  <div class="topbar">
    <div>
      <div class="topbar-title">Painel Geral</div>
      <div class="topbar-sub">Visão geral do acervo e movimentações</div>
    </div>
  </div>

  <div class="content">

    <div class="stats-grid">

      <div class="stat-card">
        <div class="stat-icon-wrap">📖</div>
        <div>
          <?= count($livros) ?>
          <div class="stat-lbl">Livros no acervo</div>
        </div>
      </div>

      <div class="stat-card">
        <div class="stat-icon-wrap">🎓</div>
        <div>
          <?= count($alunos) ?>
          <div class="stat-lbl">Alunos cadastrados</div>
        </div>
      </div>

      <div class="stat-card">
        <div class="stat-icon-wrap">📋</div>
        <div>
          <?= count($emprestimos) ?>
          <div class="stat-lbl">Empréstimos ativos</div>
        </div>
      </div>

      <div class="stat-card">
        <div class="stat-icon-wrap">⚠️</div>
        <div class="stat-val" style="color:var(--red)">
          <?= $atrasados ?>
        </div>
        <div class="stat-lbl">Em atraso</div>
      </div>

    </div>

    <div class="menu-grid">

      <a href="livros/listar.php" class="menu-card">
        <span class="menu-card-icon">📚</span>
        <div class="menu-card-title">Livros</div>
        <div class="menu-card-desc">Gerencie o acervo: cadastre, edite e remova títulos do estoque.</div>
        <div class="menu-card-arrow">Acessar →</div>
      </a>

      <a href="alunos/listar.php" class="menu-card">
        <span class="menu-card-icon">👩‍🎓</span>
        <div class="menu-card-title">Alunos</div>
        <div class="menu-card-desc">Gerencie os alunos cadastrados: nome, matrícula, sexo e nascimento.</div>
        <div class="menu-card-arrow">Acessar →</div>
      </a>

      <a href="emprestimos/listar.php" class="menu-card">
        <span class="menu-card-icon">🔖</span>
        <div class="menu-card-title">Empréstimos</div>
        <div class="menu-card-desc">Registre empréstimos, datas de devolução e acompanhe atrasos.</div>
        <div class="menu-card-arrow">Acessar →</div>
      </a>

    </div>

  </div>
</main>

</body>
</html>