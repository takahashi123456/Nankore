<?php 
ini_set('display_errors', "On");

session_start();
require('dbconnect.php');

if (!isset($_SESSION['join'])){
    header('Location:index.php');
    exit();
    
}
if (!empty($_POST)) {
    // 登録処理をする
    $statement = $db->prepare('INSERT INTO members SET name=?, email=?,	password=?, picture=?, created=NOW()');
    echo $ret = $statement->execute(array(
        $_SESSION['join']['name'],
        $_SESSION['join']['email'],
        sha1($_SESSION['join']['password']),
        $_SESSION['join']['image']
    ));
    unset($_SESSION['join']);
    header('Location: thanks.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <link href="https://unpkg.com/sanitize.css"rel="stylesheet"/>
    <link  href="https://unpkg.com/sanitize.css/forms.css"  rel="stylesheet"/>
    <link  href="https://unpkg.com/sanitize.css/typography.css" rel="stylesheet"/>
	<link rel="stylesheet" href="./css/style.css" />
</head>

<body>
<div class="center">
    <p>次のフォームに必要事項を確認してください</p>
    <form action="" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="action" value="submit" \>
    <dl>
        <dt>ニックネーム</dt>
        <dd class="dd"><?php echo htmlspecialchars($_SESSION['join']['name'], ENT_QUOTES);?></dd>
        <dt>メールアドレス</dt>
        <dd class="dd"><?php echo htmlspecialchars($_SESSION['join']['email'], ENT_QUOTES);?></dd>
        <dt>パスワード</dt>
        <dd class="dd">【表示されません】</dd>
        <dt>写真など</dt>
        <dd class="dd"><img class="checkimg" src="<?php echo htmlspecialchars($_SESSION['join']['image'], ENT_QUOTES,'UTF-8'); ?>" alt=""></dd>
        <div class="button2"><a href="index.php?action=rewrite" class="button2 reset flat border">&laquo;&nbsp;描き直す</a>
        <input type="submit" value="入力内容を送信する" class="reset flat border"></div>
    </dl>
    </form>
    <div><?php 


    ?></div>
</div>
</body>

</html>