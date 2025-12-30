<?php
session_start();
require_once 'db.php';

$erro = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome  = $_POST['nome']  ?? '';
    $senha = $_POST['senha'] ?? '';

    $stmt = $pdo->prepare("SELECT * FROM admins WHERE nome = ?");
    $stmt->execute([$nome]);
    $admin = $stmt->fetch();

    if ($admin && password_verify($senha, $admin['senha'])) {
        $_SESSION['admin_id'] = $admin['id'];
        $_SESSION['admin_nome'] = $admin['nome'];
        header('Location: index.php');
        exit;
    } else {
        $erro = 'Usuário ou senha inválidos';
    }
}
?>
<!doctype html>
<html lang="pt-br">
<head>
  <meta charset="utf-8">
  <title>Login Admin</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container py-5" style="max-width:400px">
  <h3 class="mb-4">Painel Admin</h3>

  <?php if ($erro): ?>
    <div class="alert alert-danger"><?= htmlspecialchars($erro) ?></div>
  <?php endif; ?>

  <form method="post">
    <div class="mb-3">
      <label>Usuário</label>
      <input name="nome" class="form-control" required>
    </div>
    <div class="mb-3">
      <label>Senha</label>
      <input name="senha" type="password" class="form-control" required>
    </div>
    <button class="btn btn-dark w-100">Entrar</button>
  </form>
</div>
</body>
</html>
