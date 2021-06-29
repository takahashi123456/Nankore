<?php 
    ini_set('display_errors', "On");
    session_start();
    require('dbconnect.php');


    if (isset($_SESSION['id']) && $_SESSION['time'] + 3600 > time()) {
        $_SESSION['time'] = time();
        $members = $db->prepare('SELECT * FROM members WHERE id=?');
        $members->execute(array($_SESSION['id']));
        $member = $members->fetch();
    } else {
        header('Location:../login.php');
        exit();
        
    }

        //データの取得
        $posts = $db->query('SELECT m.name, m.picture, p.* FROM members m, posts p WHERE m.id=p.user_id ORDER BY p.created DESC');
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <link href="https://unpkg.com/sanitize.css"rel="stylesheet"/>
    <link  href="https://unpkg.com/sanitize.css/forms.css"  rel="stylesheet"/>
    <link  href="https://unpkg.com/sanitize.css/typography.css" rel="stylesheet"/>
	<link rel="stylesheet" href="../style.css"/>

</head>

<body class="list">
    <div class="center list">
    <div class="block2">
        <p>写真：</p>
        <p>　　　タイトル：</p>
        <p>　　　著者：</p>
        <p>　　　メモ：</p>
        <p>　　　登録者</p>
        <p>　　　登録日：</p>
    </div>
    <?php
    foreach ($posts as $post):
    ?>  
    <div class="block2">
        <img src=".<?php echo htmlspecialchars($post['picture'], ENT_QUOTES); ?>" alt="" width="100" height="100">
        <p><?php echo htmlspecialchars($post['title'], ENT_QUOTES);?></p>
        <p><?php echo htmlspecialchars($post['author'], ENT_QUOTES); ?>）</span></p>
        <p><?php echo htmlspecialchars($post['message'], ENT_QUOTES);?> </p>
        <p><?php echo htmlspecialchars($post['name'], ENT_QUOTES); ?>）</p>
        <p><?php echo htmlspecialchars($post['created'], ENT_QUOTES); ?></p>
    </div>
    <?php 
        endforeach;
    ?>
    </div>
</body>