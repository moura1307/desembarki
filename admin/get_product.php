<?php
require_once 'auth.php';
require_once 'db.php';

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

if($id) {
    $stmt = $pdo->prepare("SELECT * FROM produtos WHERE id = ?");
    $stmt->execute([$id]);
    $product = $stmt->fetch();

    if ($product) {
        // Busca Imagens
        $stmtImg = $pdo->prepare("SELECT caminho_arquivo FROM produto_imagens WHERE produto_id = ?");
        $stmtImg->execute([$id]);
        $product['imagens'] = $stmtImg->fetchAll(PDO::FETCH_COLUMN);

        // Busca Tamanhos e Preços
        // Busca Tamanhos
        $stmtTam = $pdo->prepare("SELECT tamanho FROM produto_tamanhos WHERE produto_id = ?");
        $stmtTam->execute([$id]);
        $product['tamanhos'] = $stmtTam->fetchAll(PDO::FETCH_COLUMN);

        header('Content-Type: application/json');
        echo json_encode($product);
        exit;
    }
}