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
//データの入力
    if (!empty($_POST)) {
        if ($_POST['message'] != '') {
            $message = $db->prepare('INSERT INTO posts SET user_id=?, title=?, author=?,ASIN=?,message=?,created=NOW()');
            $message->execute(array(
                $member['id'],
                $_POST['title'],
                $_POST['author'],
                $_POST['ASIN'],
                $_POST['message']
            ));
            header('Location: list.php'); exit();
        }
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
	<link rel="stylesheet" href="../css/style.css"/>

</head>

<body>
    <h1>投稿用画面</h1>
    <div class="center">
    <form action="" method="post">
        <p><?php echo htmlspecialchars($member['name'] , ENT_QUOTES) ;?> さん、ようこそ</p>
        <div class="cp_iptxt">
            <input class="ef" type="text" name="title" size="35" placeholder="">
            <label>title</label>
            <span class="focus_line"></span>
        </div>
            <!-- <dt>タイトル</dt>
            <dd>
                <textarea name="title" cols="30" rows="10"></textarea>
            </dd> -->

        <div class="cp_iptxt">
            <input class="ef" type="text" name="author" size="35" placeholder="">
            <label>著者</label>
            <span class="focus_line"></span>
        </div>
            <!-- <dt>著者</dt>
            <dd>
                <textarea name="author" cols="30" rows="10"></textarea>
            </dd> -->

        <div class="cp_iptxt">
            <input class="ef" type="text" name="ASIN" size="35" placeholder="">
            <label>ASIN</label>
            <span class="focus_line"></span>
        </div>
            <!-- <dt>ASINコード</dt>
            <dd>
                <textarea name="ASIN" cols="30" rows="10"></textarea>
            </dd> -->
        <div class="cp_iptxt">
            <textarea class="ef message"  name="message" size="35" placeholder=""></textarea>
            <label>メッセージ</label>
            <span class="focus_line "></span>
        </div>
            <!-- <dt>メッセージを投稿</dt>
            <dd>
                <textarea name="message"  cols="50" rows="5"></textarea>
            </dd>
        </dl> -->
        <div>
            <input type="submit" value="登録する">
        </div>
    </form>
    </div>
    <!-- 投稿内容を表示する -->
    <p>test</p>
    <?php
    foreach ($posts as $post):
    ?>  
    <div>
        <img src="<?php echo htmlspecialchars($post['picture'], ENT_QUOTES); ?>" alt="" width="48" height="48">
        <p><?php echo htmlspecialchars($post['message'], ENT_QUOTES);?><span class="name">（<?php echo htmlspecialchars($post['name'], ENT_QUOTES); ?>）</span></p>
        <p><?php echo htmlspecialchars($post['created'], ENT_QUOTES); ?></p>
    </div>
    <?php 
        endforeach;
    ?>

</body>

</html>