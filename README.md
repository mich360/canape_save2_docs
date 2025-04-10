<meta charset="UTF-8">

# 運用先

[Project作り方](http://canape.stars.ne.jp/save_b2/navbars-offcanvas/main.php)<br>
[管理者ログイン](http://canape.stars.ne.jp/save_b/login.php)<br>
[訪問者の声（管理パネル）](http://canape.stars.ne.jp/save_b/admin_panel.php)

## ファイル一覧

```text
http://canape.stars.ne.jp/save_b2/navbars-offcanvas/main.php ページ内の
「Lauchボタン」管理ファイルを作成しました。

admin_config.php     : 自分だけのユーザー・パスワード設定　非表示の設定ファイル
admin_panel.php      : 訪問者の声 管理パネル
delete.php           : 削除処理
edit.php             : 編集画面
login.php            : ログイン
logout.php           : ログアウト
README.md            : この説明
.htaccess            : admin_config.phpへのアクセス拒否
```

### パスワード保護

```text
やりたいこと PWの安全                     対応方法

admin_config.php を安全に置きたい      /htpasswd フォルダに設置

PHPから読み込む方法      require_once(__DIR__ . '/../htpasswd/admin_config.php');

public_htmlに置く場合の対策   .htaccess でアクセス拒否設定をする
```

---

# データベースに作成

## setup.sql を デスクトップ に保存したとします

```sql
-- データベースを使用
USE ww2019_sample;

-- もし同じテーブルが存在していたら削除
DROP TABLE IF EXISTS m_date;

-- テーブル作成
CREATE TABLE m_date (
    id INT AUTO_INCREMENT PRIMARY KEY,
    data1 VARCHAR(255),
    data2 VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- テストデータを挿入
INSERT INTO m_date (data1, data2) VALUES ('テスト1', 'データ1');
INSERT INTO m_date (data1, data2) VALUES ('テスト2', 'データ2');
INSERT INTO m_date (data1, data2) VALUES ('テスト3', 'データ3');
```

### ターミナルで次のように移動します：

```code
cd ~/Desktop
```

### そして、MySQLコマンドを実行：

```code
mysql -u root -p < setup.sql
```

```text
root の部分は、使っているユーザー名に置き換えてください
実行後、パスワードを聞かれます（MAMPなら多くの場合 root）。
```

### phpmyadminを使う場合　インポートするか、　SQLに貼り付ける

---



# ✅ Webでこの .md を表示するベストな方法


## 【1】GitHub Pagesで表示する（静的サイト化）

```text
MarkdownをHTMLページとしてきれいに公開したいなら：

🔧 手順概要：
GitHubでリポジトリを作成（例: canape-docs）

README.md などMarkdownファイルをアップロード

GitHub Pages を有効にする（設定 → Pages → ソースを選択）

自動でMarkdownがHTML化されてWeb表示される
```

## ✅ メリット：

```text

無料＆公開可能

スマホにも対応

Markdownそのままでもきれいに表示
```

## 【2】HTMLページとして埋め込みたい場合（カスタムサイト用）

```text

あなたの canape.stars.ne.jp サイト内で、Markdownをそのまま読み込んでHTML化する方法もあります：

📄 例：README.mdをHTMLで表示するコード
html
```

```html
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>README表示</title>
  <script src="https://cdn.jsdelivr.net/npm/markdown-it/dist/markdown-it.min.js"></script>
</head>
<body>
  <div id="content">読み込み中...</div>
  <script>
    const md = window.markdownit();
    fetch('README.md')  // 同じディレクトリにREADME.mdがある前提
      .then(res => res.text())
      .then(text => {
        document.getElementById('content').innerHTML = md.render(text);
      });
  </script>
</body>
</html>
```

## ✅ メリット：

```text
Markdown編集はそのまま

Web表示はHTMLスタイルに変換
```

## 【3】Markdown → HTML に変換してアップする

```text
コマンドで一度 .md → .html にして、public_html にアップロードする方法もあります。

🛠 コマンド例（macOS ターミナル）：
```

```code
cd ~/Desktop

pandoc README.md -s -o README.html
```

```text
この README.html をそのままサーバーに置けば、ブラウザで見られます
```


