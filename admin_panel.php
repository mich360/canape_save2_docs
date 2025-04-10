<?php　　//　　　admin_panel.php
session_start();
if (!isset($_SESSION["logged_in"])) {
    header("Location: login.php");
    exit;
}

// DB接続（↓DB名、ユーザー、パスワードは必要に応じて変更してください）
$pdo = new PDO('mysql:host=localhost;dbname=canape_sample;charset=utf8', 'canape_20250324', 'KApd5.GgaKc6vA4');

// データ取得
$stmt = $pdo->query("SELECT * FROM m_date ORDER BY created_at DESC");

?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>管理パネル - 訪問者の声</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <h1 class="mb-4 text-center">📋 訪問者の声（管理パネル）</h1>

    <?php while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) : ?>
        <div class="card mb-3 shadow-sm">
            <div class="card-body">
                <h5 class="card-title"><?= htmlspecialchars($row['data1']) ?> さん</h5>
                <p class="card-text"><?= nl2br(htmlspecialchars($row['data2'])) ?></p>
                <p class="card-subtitle text-muted small">
                    投稿日時: <?= htmlspecialchars($row['created_at']) ?>
                </p>
                <div class="mt-3">
                    <a href="edit.php?id=<?= $row['id'] ?>" class="btn btn-outline-success btn-sm">編集</a>
                    <a href="delete.php?id=<?= $row['id'] ?>" class="btn btn-outline-danger btn-sm"
                       onclick="return confirm('本当に削除しますか？');">削除</a>
                </div>
            </div>
        </div>
    <?php endwhile; ?>

    <div class="text-center mt-5">
        <a href="logout.php" class="btn btn-secondary">ログアウト</a>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>


<!-- 🧠 意味を分解して説明すると：
ORDER BY created_at DESC
🔹 ORDER BY created_at
created_at という列（通常「作成日時」を格納）で並び替えを行います。
🔻 DESC（降順）
新しいものから古いものへ 並び替えます。
DESC は Descending（降順） の略です。 -->

<!-- ✅ 全体の意味：
m_date テーブルの全てのデータを、created_at カラムの 新しい順 に取得する。 -->

<!-- 🔁 補足：逆にしたいときは？
ORDER BY created_at ASC

ASC = Ascending（昇順）
古いものから新しいものへ 並び替えます。-->

