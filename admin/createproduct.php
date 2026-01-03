<?php
require_once 'auth.php';
require_once 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && ($_POST['action'] ?? '') === 'add') {
    $nome      = trim($_POST['nome'] ?? '');
    $descricao = trim($_POST['descricao'] ?? '');
    $gramatura = $_POST['gramatura'] !== '' ? (int)$_POST['gramatura'] : null;

    // Gerar Slug a partir do nome
    $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $nome)));

    if ($nome === '') {
        header('Location: index.php?error=nome_obrigatorio');
        exit;
    }

    try {
        $pdo->beginTransaction();

        // 1. Inserir produto (sem coluna preco)
        $stmt = $pdo->prepare("
            INSERT INTO produtos (nome, slug, descricao, gramatura)
            VALUES (:nome, :slug, :descricao, :gramatura)
        ");
        $stmt->execute([
            ':nome'      => $nome,
            ':slug'      => $slug,
            ':descricao' => $descricao,
            ':gramatura' => $gramatura
        ]);

        $produto_id = $pdo->lastInsertId();

        // 2. Inserir Tamanhos
        // Inserir Tamanhos
        $tamanhos = $_POST['tamanhos'] ?? [];
        foreach ($tamanhos as $tam) {
            $tam = trim($tam);
            if (!empty($tam)) {
                $stmtTam = $pdo->prepare("INSERT INTO produto_tamanhos (produto_id, tamanho) VALUES (?, ?)");
                $stmtTam->execute([$produto_id, $tam]);
            }
        }

        // 3. Inserir Imagens
        $imagens = $_POST['imagens'] ?? [];
        foreach ($imagens as $url) {
            $url = trim($url);
            if (!empty($url)) {
                $stmtImg = $pdo->prepare("INSERT INTO produto_imagens (produto_id, caminho_arquivo) VALUES (?, ?)");
                $stmtImg->execute([$produto_id, $url]);
            }
        }

        $pdo->commit();
        header('Location: index.php?success=1');
        exit;
    } catch (Exception $e) {
        $pdo->rollBack();
        header('Location: index.php?error=' . urlencode($e->getMessage()));
        exit;
    }
}