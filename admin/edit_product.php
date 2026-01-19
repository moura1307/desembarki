<?php
require_once 'auth.php';
require_once 'db.php';

// Verifica se o ID foi passado
if (!isset($_GET['id'])) {
    header('Location: index.php');
    exit;
}   

$id = (int) $_GET['id'];

// 1. Procurar o produto no banco de dados (Usando os nomes das colunas da sua imagem)
$stmt = $pdo->prepare("SELECT * FROM produtos WHERE id = ?");
$stmt->execute([$id]);
$product = $stmt->fetch();

if (!$product) {
    die('Produto não encontrado.');
}

// 2. Processar a atualização quando o formulário é enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome      = trim($_POST['name'] ?? '');
    $descricao = trim($_POST['descricao'] ?? '');
    $gramatura = !empty($_POST['gramatura']) ? (int) $_POST['gramatura'] : null;
    $slug      = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $nome)));

    try {
        $pdo->beginTransaction();

        // Atualiza tabela principal
        $update = $pdo->prepare("UPDATE produtos SET nome = ?, slug = ?, descricao = ? WHERE id = ?");
        $update->execute([$nome, $slug, $descricao, $id]);

        // Sincroniza Gramaturas
        $pdo->prepare("DELETE FROM produto_gramaturas WHERE produto_id = ?")->execute([$id]);
        $gramaturas = $_POST['gramaturas'] ?? [];
        foreach ($gramaturas as $gram) {
            if (!empty(trim($gram))) {
                $pdo->prepare("INSERT INTO produto_gramaturas (produto_id, gramatura) VALUES (?, ?)")->execute([$id, trim($gram)]);
            }
        }   
        
        // Sincroniza Tamanhos (Deleta e reinsere)
        // Sincroniza Tamanhos
        $delTam = $pdo->prepare("DELETE FROM produto_tamanhos WHERE produto_id = ?");
        $delTam->execute([$id]);

        $tamanhos = $_POST['tamanhos'] ?? [];
        foreach ($tamanhos as $tam) {
            if (!empty(trim($tam))) {
                $insTam = $pdo->prepare("INSERT INTO produto_tamanhos (produto_id, tamanho) VALUES (?, ?)");
                $insTam->execute([$id, trim($tam)]);
            }
        }

        // Sincroniza Imagens (Deleta e reinsere)
        $delImg = $pdo->prepare("DELETE FROM produto_imagens WHERE produto_id = ?");
        $delImg->execute([$id]);

        $imagens = $_POST['imagens'] ?? [];
        foreach ($imagens as $url) {
            if (!empty(trim($url))) {
                $insImg = $pdo->prepare("INSERT INTO produto_imagens (produto_id, caminho_arquivo) VALUES (?, ?)");
                $insImg->execute([$id, trim($url)]);
            }
        }

        $pdo->commit();
        echo json_encode(['status' => 'success']);
        exit;
    } catch (Exception $e) {
        $pdo->rollBack();
        http_response_code(500);
        echo json_encode(['error' => $e->getMessage()]);
        exit;
    }
}
?>