<?php
require_once 'auth.php';
require_once 'db.php';

ini_set('display_errors', 1);
error_reporting(E_ALL);

$messages = [];

/* =========================
   PROCESSA O FORMULÁRIO (ADD)
========================= */
if ($_SERVER['REQUEST_METHOD'] === 'POST' && ($_POST['action'] ?? '') === 'add') {
  $nome        = trim($_POST['nome'] ?? '');
  $descricao   = trim($_POST['descricao'] ?? '');
  $gramatura   = $_POST['gramatura'] !== '' ? (int)$_POST['gramatura'] : null;
  $preco       = isset($_POST['preco']) ? (float)$_POST['preco'] : 0;
  $imagem      = trim($_POST['imagem_url'] ?? '');

  if ($nome === '' || $preco <= 0) {
    $messages[] = ['type' => 'danger', 'text' => 'Nome e preço são obrigatórios.'];
  } else {
    try {
      // AJUSTADO: Usando nomes das colunas em português conforme sua imagem
      $stmt = $pdo->prepare("
                INSERT INTO produtos (nome, descricao, gramatura, preco, imagem)
                VALUES (:nome, :descricao, :gramatura, :preco, :imagem)
            ");

      $stmt->execute([
        ':nome'      => $nome,
        ':descricao' => $descricao,
        ':gramatura' => $gramatura,
        ':preco'     => $preco,
        ':imagem'    => $imagem
      ]);

      header('Location: index.php?success=1');
      exit;
    } catch (Exception $e) {
      $messages[] = ['type' => 'danger', 'text' => 'Erro ao salvar: ' . $e->getMessage()];
    }
  }
}

/* =========================
   LISTA OS PRODUTOS
========================= */
$products = $pdo->query("SELECT * FROM produtos ORDER BY id DESC")->fetchAll();
?>

<!doctype html>
<html lang="pt-br">

<head>
  <meta charset="utf-8">
  <title>Admin - Desembarki</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

  <div class="container py-5">
    <h1 class="mb-4">Gerenciar Produtos</h1>

    <?php foreach ($messages as $m): ?>
      <div class="alert alert-<?= $m['type'] ?>"><?= $m['text'] ?></div>
    <?php endforeach; ?>

    <div class="card mb-5 shadow-sm">
      <div class="card-body">
        <h5 class="card-title mb-3">Adicionar Novo Produto</h5>
        <form method="post">
          <input type="hidden" name="action" value="add">

          <div class="mb-3">
            <label class="form-label">Nome do Produto</label>
            <input name="nome" class="form-control" required>
          </div>

          <div class="mb-3">
            <label class="form-label">Descrição</label>
            <textarea name="descricao" class="form-control" rows="2"></textarea>
          </div>

          <div class="row">
            <div class="col-md-4 mb-3">
              <label class="form-label">Gramatura (g)</label>
              <input name="gramatura" type="number" class="form-control">
            </div>
            <div class="col-md-4 mb-3">
              <label class="form-label">Preço (R$)</label>
              <input name="preco" type="number" step="0.01" class="form-control" required>
            </div>
            <div class="col-md-4 mb-3">
              <label class="form-label">URL da Imagem</label>
              <input name="imagem_url" class="form-control" placeholder="http://...">
            </div>
          </div>

          <button type="submit" class="btn btn-primary">Salvar no Banco</button>
        </form>
      </div>
    </div>

    <h3 class="mb-3">Lista de Produtos</h3>
    <table class="table table-hover bg-white border shadow-sm">
      <thead class="table-dark">
        <tr>
          <th>ID</th>
          <th>Foto</th>
          <th>Nome</th>
          <th>Gramatura</th>
          <th>Preço</th>
          <th>Ações</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($products as $p): ?>
          <tr class="align-middle">
            <td><?= $p['id'] ?></td>
            <td>
              <?php if (!empty($p['imagem'])): ?>
                <img src="<?= htmlspecialchars($p['imagem']) ?>" width="50" height="50" class="rounded border" style="object-fit: cover;">
              <?php else: ?>
                <span class="text-muted small">Sem foto</span>
              <?php endif; ?>
            </td>
            <td><?= htmlspecialchars($p['nome']) ?></td>
            <td><?= $p['gramatura'] ? $p['gramatura'] . 'g' : '-' ?></td>
            <td>R$ <?= number_format($p['preco'], 2, ',', '.') ?></td>
            <td>
              <button class="btn btn-sm btn-outline-danger">Remover</button>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>

</body>

</html>