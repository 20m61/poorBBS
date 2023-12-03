<!-- |||||||||||||||||| poorPHP |||||||||||||||||| -->
<!-- これはシンプルな掲示板です。アカウント作成不要・DB不使用で、PHPが利用できる環境下に置くだけでBBSとして利用できます -->
<?php
// メッセージが投稿された場合
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // メッセージをテキストファイルに保存
    $newMessage = $_POST['name'] . ' ' . date('Y-m-d H:i:s') . ' ' . $_POST['message'];
    file_put_contents('messages.txt', $newMessage . "\n", FILE_APPEND);
}

// メッセージを読み込む
$messages = file('messages.txt', FILE_IGNORE_NEW_LINES);

?>

<!DOCTYPE html>
<html>

<head>
    <title>シンプルな掲示板</title>
</head>

<body>
    <h1>シンプルな掲示板</h1>
    <form method="POST">
        <input type="text" name="name" placeholder="名前" required>
        <input type="text" name="message" placeholder="メッセージ" required>
        <input type="submit" value="投稿">
    </form>
    <h2>メッセージ一覧</h2>
    <ul>
        <?php foreach ($messages as $message) : ?>
            <li>
                <?php
                $parts = explode(' ', $message, 3);
                echo htmlspecialchars($parts[0], ENT_QUOTES, 'UTF-8');  // 名前
                echo ' (' . $parts[1] . ')';  // タイムスタンプ
                echo ': ' . htmlspecialchars($parts[2], ENT_QUOTES, 'UTF-8');  // メッセージ
                ?>
            </li>
        <?php endforeach; ?>
    </ul>
</body>

</html>