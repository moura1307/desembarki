<?php

if (!isset($_GET['id'])) header('Location: index.php');
$id = intval($_GET['id']);

// get image path to unlink
$stmt = $pdo->prepare("SELECT image FROM products WHERE id = ?");
$stmt->execute([$id]);
$row = $stmt->fetch();
if ($row && $row['image']) {
    $file = __DIR__ . '/../' . $row['image'];
    if (file_exists($file)) unlink($file);
}

// delete
$del = $pdo->prepare("DELETE FROM products WHERE id = ?");
$del->execute([$id]);
header('Location: index.php');
