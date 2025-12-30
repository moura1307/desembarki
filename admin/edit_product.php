<?php


if (!isset($_GET['id'])) {
    header('Location: index.php');
    exit;
}

$id = (int) $_GET['id'];

// Buscar produto
$stmt = $pdo->prepare("SELECT * FROM products WHERE id = ?");
$stmt->execute([$id]);
$product = $stmt->fetch();

if (!$product) {
    die('Produto não encontrado.');
}

$messages = [];

// Atualizar produto
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $description = trim($_POST['description'] ?? '');
    $gramatura = $_POST['gramatura'] !== '' ? (int) $_POST['gramatura'] : null;
    $price = (float) ($_POST['price'] ?? 0);

    if ($name === '' || $price <= 0) {
        $messages[] = ['type' => 'danger', 'text' => 'Nome e preço são obrigatórios.'];
    } else {

        $imagePath = $product['image'];

        // Se enviou nova imagem
        if (!empty($_FILES['image']) && $_FILES['image']['error'] !== UPLOAD_ERR_NO_FILE) {

            $allowedExt = ['jpg', 'jpeg', 'png', 'webp'];
            $maxSize = 2 * 1024 * 1024;
            $ext = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));

            if (
                $_FILES['image']['error'] !== UPLOAD_ERR_OK ||
                $_FILES['image']['size'] > $maxSize ||
                !in_array($ext, $allowedExt)
            ) {
                $messages[] = ['type' => 'danger', 'text' => 'Imagem inválida (JPG, PNG ou WebP até 2MB).'];
            } else {

                // Apagar imagem antiga
                if ($imagePath && file_exists(__DIR__ . '/../' . $imagePath)) {
                    unlink(__DIR__ . '/../' . $imagePath);
                }

                $newName = time() . '_' . bin2hex(random_bytes(6)) . '.' . $ext;
                $dest = __DIR__ . '/../uploads/products/' . $newName;

                if (!move_uploaded_file($_FILES['image']['tmp_name'], $dest)) {
                    $messages[] = ['type' => 'danger', 'text' => 'Erro ao salvar a nova imagem.'];
                } else {
                    $imagePath = 'uploads/products/' . $newName;
                }
            }
        }

        if (empty($messages)) {
            $update = $pdo->prepare("
                UPDATE products 
                SET name = ?, description = ?, gramatura = ?, price = ?, image = ?
                WHERE id = ?
            ");

            $update->execute([
                $name,
                $description,
                $gramatura,
                $price,
                $imagePath,
                $id
            ]);

            header('Location: index.php');
            exit;
        }
    }
}
?>
<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <title>Editar Produto</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container py-5">
    <h1>Editar Produto</h1>

    <?php foreach ($messages as $m): ?>
        <div class="alert alert-<?= $m['type'] ?>">
            <?= htmlspecialchars($m['text']) ?>
        </div>
    <?php endforeach; ?>

    <div class="card">
        <div class="card-body">
            <form method="post" enctype="multipart/form-data">

                <div class="mb-3">
                    <label class="form-label">Nome</label>
                    <input type="text" name="name" class="form-control"
                           value="<?= htmlspecialchars($product['name']) ?>" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Descrição</label>
                    <textarea name="description" class="form-control" rows="4"><?= htmlspecialchars($product['description']) ?></textarea>
                </div>

                <div class="row mb-3">
                    <div class="col-md-4">
                        <label class="form-label">Gramatura (g)</label>
                        <input type="number" name="gramatura" class="form-control"
                               value="<?= htmlspecialchars($product['gramatura']) ?>">
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Preço</label>
                        <input type="number" step="0.01" name="price" class="form-control"
                               value="<?= htmlspecialchars($product['price']) ?>" required>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Nova Imagem (opcional)</label>
                        <input type="file" name="image" class="form-control" accept="image/*">
                    </div>
                </div>

                <?php if ($product['image']): ?>
                    <div class="mb-3">
                        <p class="mb-1">Imagem atual:</p>
                        <img src="../<?= htmlspecialchars($product['image']) ?>"
                             style="max-width: 200px; border-radius: 5px;">
                    </div>
                <?php endif; ?>

                <div class="d-flex gap-2">
                    <button class="btn btn-dark">Salvar Alterações</button>
                    <a href="index.php" class="btn btn-outline-secondary">Cancelar</a>
                </div>

            </form>
        </div>
    </div>
</div>

</body>
</html>
