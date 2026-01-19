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

        $stmt = $pdo->prepare("
            INSERT INTO produtos (nome, slug, descricao)
            VALUES (:nome, :slug, :descricao)
        ");
        
        $stmt->execute([
            ':nome'      => $nome,
            ':slug'      => $slug,
            ':descricao' => $descricao
        ]);

        $produto_id = $pdo->lastInsertId();

        $gramaturas = $_POST['gramaturas'] ?? [];
        foreach ($gramaturas as $gram) {
            if (!empty(trim($gram))) {
                $stmtGram = $pdo->prepare("INSERT INTO produto_gramaturas (produto_id, gramatura) VALUES (?, ?)");
                $stmtGram->execute([$produto_id, trim($gram)]);
            }
        }
        
        $tamanhos = $_POST['tamanhos'] ?? [];
        foreach ($tamanhos as $tam) {
            $tam = trim($tam);
            if (!empty($tam)) {
                $stmtTam = $pdo->prepare("INSERT INTO produto_tamanhos (produto_id, tamanho) VALUES (?, ?)");
                $stmtTam->execute([$produto_id, $tam]);
            }
        }
        
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