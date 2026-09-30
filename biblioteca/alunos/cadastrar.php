<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cadastrar Aluno — Biblioteca</title>
  <link rel="stylesheet" href="../assets/style.css">
</head>
<body>

<!-- ============================================================
  TODO PHP — Topo do arquivo alunos/cadastrar.php:
  <?php
  require_once '../includes/auth.php';
  require_once '../includes/funcoes.php';
  require_once '../includes/conexaobd.php';
  require_once '../models/aluno.php';
    require_once '../includes/navbar.php';
  $erro = '';

  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $nome      = trim($_POST['nome']);
      $matricula = trim($_POST['matricula']);
      $sexo      = $_POST['sexo'] ?? '';
      $dataNasc  = trim($_POST['dataNascimento']);

      if (!$nome || !$matricula || !$sexo || !$dataNasc) {
          $erro = 'Preencha todos os campos obrigatórios.';
      } else {
          $alunos = Aluno::listarTodos($conn)
          foreach ($alunos as $a) {
              if ($a->matricula === $matricula) { $erro = 'Matrícula já cadastrada.'; break; }
          }
          if (!$erro) {
              $aluno = new Aluno($nome, $matricula, $sexo, $dataNasc);
              $aluno->cadastrar($conn);

              // no txt:
              

              header('Location: listar.php?msg=cadastrado');
              exit;
          }
      }
  }
  ?>
============================================================ -->


  <!-- ════ MAIN ════ -->
  <main class="main">
    <div class="topbar">
      <div>
        <div class="topbar-title">➕ Cadastrar Aluno</div>
        <div class="topbar-sub">Adicionar novo aluno ao sistema</div>
      </div>
      <div class="topbar-actions">
        <a href="listar.php" class="btn btn-ghost">← Voltar</a>
      </div>
    </div>

    <div class="content">

      <?php if ($erro): ?>
        <div class="alert alert-error">⚠ <?= htmlspecialchars($erro) ?></div>
      <?php endif; ?>

      <!-- TODO PHP: action="cadastrar.php" method="POST" -->
      <form action="cadastrar.php" method="POST">
        <div class="form-card">

          <div class="form-row">
            <div class="form-group full">
              <label for="nome">Nome completo *</label>
              <!-- TODO PHP: " -->
              <input type="text" id="nome" name="nome"
                     placeholder="Ex: Ana Beatriz Souza"
                     value="<?= htmlspecialchars($_POST['nome'] ?? '') ?>"
                      required>
            </div>
          </div>

          <div class="form-row">
            <div class="form-group">
              <label for="matricula">Matrícula *</label>
              <!-- TODO PHP:  -->
              <input type="text" id="matricula" name="matricula"
                     placeholder="Ex: 2024009" 
                     value="<?= htmlspecialchars($_POST['matricula'] ?? '') ?>"
                     required>
            </div>
            <div class="form-group">
              <label for="sexo">Sexo *</label>
              <!-- TODO PHP: selected conforme $_POST['sexo'] ?? '' -->
              <select id="sexo" name="sexo" required>
                <option value="">Selecione</option>
                <option value="M">Masculino</option>
                <option value="F">Feminino</option>
              </select>
            </div>
          </div>

          <div class="form-row cols-1">
            <div class="form-group">
              <label for="dataNascimento">Data de nascimento *</label>
              <!-- TODO PHP:  -->
              <input type="date" id="dataNascimento" name="dataNascimento"
              value="<?= htmlspecialchars($_POST['dataNascimento'] ?? '') ?>"
               required>
            </div>
          </div>

          <div class="form-actions">
            <button type="submit" class="btn btn-primary">Cadastrar aluno</button>
            <a href="listar.php" class="btn btn-ghost">Cancelar</a>
          </div>

        </div>
      </form>

    </div>
  </main>
</div>

</body>
</html>
