<?php
session_start();
if (!isset($_SESSION["logged_in"])) {
    header("Location: login.php");
    exit;
}
$pdo = new PDO('mysql:host=localhost;dbname=canape_sample;charset=utf8', 'canape_20250324', 'KApd5.GgaKc6vA4');

// 編集対象のIDを取得
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

// フォーム送信時の処理
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data1 = $_POST['data1'];
    $data2 = $_POST['data2'];

    $stmt = $pdo->prepare("UPDATE m_date SET data1 = ?, data2 = ?, updated_at = NOW() WHERE id = ?");
    $stmt->execute([$data1, $data2, $id]);

    header("Location: admin_panel.php");
    exit;
}

// 編集フォーム表示
$stmt = $pdo->prepare("SELECT * FROM m_date WHERE id = ?");
$stmt->execute([$id]);
$row = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$row) {
   echo "指定されたIDのデータが見つかりません。<br>";
   echo "<a href='admin_panel.php'>戻る</a><br>";
   var_dump($id);  // IDの値を確認
   exit;
}
?>

<h1>メッセージの編集</h1>
<form method="POST">
    <p>名前：<input type="text" name="data1" value="<?= htmlspecialchars($row['data1']) ?>"></p>
    <p>内容：<br><textarea name="data2" rows="5" cols="50"><?= htmlspecialchars($row['data2']) ?></textarea></p>
    <button type="submit">更新する</button>
    <a href="admin_panel.php">キャンセル</a>
</form>
