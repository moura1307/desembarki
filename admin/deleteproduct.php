<?php
require_once 'db.php';
$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
if ($id) {
    try {
        // Basta um DELETE (o banco de dados deve tratar as imagens se houver ON DELETE CASCADE)
        $stmt = $pdo->prepare("DELETE FROM produtos WHERE id = ?");
        $stmt->execute([$id]);
    } catch (Exception $e) {
        die("Erro ao deletar: " . $e->getMessage());
    }
    header('Location: index.php?success=deletado');
    exit;  
}