<?php
session_start();
if (!isset($_SESSION["logged_in"])) {
    header("Location: login.php");
    exit;
}
$pdo = new PDO('mysql:host=localhost;dbname=canape_sample;charset=utf8', 'canape_20250324', 'KApd5.GgaKc6vA4');
// 削除対象のIDを取得
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if ($id) {
    $stmt = $pdo->prepare("DELETE FROM m_date WHERE id = ?");
    $stmt->execute([$id]);
}

header("Location: admin_panel.php");
exit;
