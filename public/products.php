<?php
require_once __DIR__ . '/../admin/db.php';
$products = $pdo->query("SELECT * FROM products ORDER BY name ASC")->fetchAll();
?>
<!doctype html>
<html lang="pt-br">
<head>
<meta charset="utf-8">
<title>Produtos - Desembarki</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
  <div class="container py-5">
    <h1>Produtos</h1>
    <div class="row">
      <?php foreach($products as $p): ?>
      <div class="col-md-4 mb-4">
        <div class="card h-100">
          <?php if ($p['image']): ?>
            <img src="../<?= htmlspecialchars($p['image']) ?>" class="card-img-top" style="height:220px;object-fit:cover" alt="">
          <?php endif; ?>
          <div class="card-body d-flex flex-column">
            <h5 class="card-title"><?= htmlspecialchars($p['name']) ?></h5>
            <p class="card-text"><?= nl2br(htmlspecialchars($p['description'])) ?></p>
            <p class="mt-auto"><strong>€ <?= number_format($p['price'],2,',','.') ?></strong></p>
          </div>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</body>
</html>
