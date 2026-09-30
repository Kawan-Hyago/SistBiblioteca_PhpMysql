<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cadastrar Livro — Biblioteca</title>
  <link rel="stylesheet" href="../assets/style.css">
</head>
<body>

  <?php
  require_once '../includes/auth.php';
  require_once '../includes/funcoes.php';
  require_once '../includes/navbar.php';
  require_once '../includes/conexaobd.php';
  require_once '../models/livro.php';
  $erro = '';

  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $nome    = trim($_POST['nome']);
      $editora = trim($_POST['editora']);
      $edicao  = trim($_POST['edicao']);
      $autor   = trim($_POST['autor']);
      $estoque = trim($_POST['estoque']);

      if (!$nome || !$editora || !$edicao || !$autor || !$estoque) {
          $erro = 'Preencha todos os campos obrigatórios.';
      } else {
          $livros = Livro::listarTodos($conn);
          $id = proximoId($livros);
          $livro = new Livro($id, $nome, $editora, $edicao, $autor, $estoque);
          $livro->cadastrar($conn);

          //no txt:
          
         
         

          header('Location: listar.php?msg=cadastrado');
          exit;
      }
  }
  ?>

  <main class="main">
    <div class="topbar">
      <div>
        <div class="topbar-title">➕ Cadastrar Livro</div>
        <div class="topbar-sub">Adicionar novo título ao acervo</div>
      </div>
      <div class="topbar-actions">
        <a href="listar.php" class="btn btn-ghost">← Voltar</a>
      </div>
    </div>

    <div class="content">

      <?php if ($erro): ?>
        <div class="alert alert-error">⚠ <?= htmlspecialchars($erro) ?></div>
      <?php endif; ?>

      <form action="cadastrar.php" method="POST">
        <div class="form-card">

          <div class="form-row cols-1">
            <div class="form-group">
              <label for="nome">Título do livro *</label>
              <input type="text" id="nome" name="nome"
                     placeholder="Ex: O Senhor dos Anéis" 
                     value="<?= htmlspecialchars($_POST['nome'] ?? '') ?>"
                     required>
            </div>
          </div>

          <div class="form-row">
            <div class="form-group">
              <label for="autor">Autor *</label>
              <input type="text" id="autor" name="autor"
                     placeholder="Ex: J.R.R. Tolkien"
                     value="<?= htmlspecialchars($_POST['autor'] ?? '') ?>"
                     required>
            </div>
            <div class="form-group">
              <label for="editora">Editora *</label>
              <input type="text" id="editora" name="editora"
                     placeholder="Ex: HarperCollins"
                     value="<?= htmlspecialchars($_POST['editora'] ?? '') ?>"
                     required>
            </div>
          </div>

          <div class="form-row">
            <div class="form-group">
              <label for="edicao">Edição *</label>
              <input type="number" id="edicao" name="edicao"
                value="<?= htmlspecialchars($_POST['edicao'] ?? '') ?>"
                required>
            </div>
            <div class="form-group">
              <label for="estoque">Quantidade em estoque *</label>
              <input type="number" id="estoque" name="estoque"
                value="<?= htmlspecialchars($_POST['estoque'] ?? '') ?>"
                required>
            </div>
          </div>

          <div class="form-actions">
            <button type="submit" class="btn btn-primary">Cadastrar livro</button>
            <a href="listar.php" class="btn btn-ghost">Cancelar</a>
          </div>

        </div>
      </form>

    </div>
  </main>
</div>

</body>
</html>
