<?php
session_start();
require 'admin_config.php';

$error = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? "";
    $password = $_POST['password'] ?? "";

    // ユーザー名とパスワードの確認
    if ($username === $admin_user && password_verify($password, $admin_pass)) {
        $_SESSION['logged_in'] = true;
        header("Location: admin_panel.php");
        exit;
    } else {
        $error = "ユーザー名またはパスワードが正しくありません。";
    }
}
error_reporting(0); // エラー報告を無効にする
ini_set('display_errors', 0); // エラー表示を無効にする

?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>管理者ログイン</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5" style="max-width: 400px;">
    <h2 class="text-center mb-4">🔐 管理者ログイン</h2>

    <?php if ($error): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <form method="POST">
        <div class="mb-3">
            <label for="username" class="form-label">ユーザー名</label>
            <input type="text" name="username" class="form-control" id="username" required>
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">パスワード</label>
            <input type="password" name="password" class="form-control" id="password" required>
        </div>

        <div class="d-grid">
            <button type="submit" class="btn btn-primary">ログイン</button>
        </div>
    </form>
</div>

</body>
</html>
<!-- admin_config.php に定義された $admin_user と $admin_pass の固定値を使ってログイン判定をしています。-->
<!-- if ($username === $admin_user && password_verify($password, $admin_pass))
ここで $admin_user（ユーザー名）と $admin_pass（ハッシュ化されたパスワード）を確認しています。 -->

<!-- 🔐 今のコードでは、ログイン後の遷移先はこちら：
header("Location: admin_panel.php");
つまり、「ログイン成功したら admin_panel.php というファイルに移動（リダイレクト）」します。 -->
