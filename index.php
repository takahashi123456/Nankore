<?php 
// ini_set('display_errors', "On");
require('dbconnect.php');
    session_start();

    if (!empty($_POST)) {
        // エラー項目の確認
        if ($_POST['name'] == '') {
                $error['name'] = 'blank';
        }
        if ($_POST['email'] == '') {
            $error['email'] = 'blank';
        }
        if (strlen($_POST['password']) < 4) {
            $error['password'] = 'length';
        }
        if ($_POST['password'] == '') {
            $error['password'] = 'blank';
        }
        $fileName = $_FILES['image']['name'];
        if (!empty($fileName)) {
            $ext = substr($fileName, -3);
            if ($ext != 'jpg' && $ext != 'gif' && $ext !="png"){
                $error['image'] = 'type';
            }
        }

        if (empty($error)) {
            $member = $db->prepare('SELECT COUNT(*) AS cnt FROM members WHERE email=?');
            $member->execute(array($_POST['email']));
            $record = $member->fetch();
            if ($record['cnt'] > 0) {
                $error['email'] = 'duplicate';
            }
        }

        // if (empty($error)) {
        //     // 画像をアップロードする
        //     $image = date('YmdHis') . $_FILES['image']['name'];
        //     move_uploaded_file($_FILES['image']['tmp_name'], '/img/' .$image);
        //     $_SESSION['join'] = $_POST;
        //     $_SESSION['join']['image'] = $image;
        //     header('Location: check.php');
        //     exit();
        // }
        if (empty($error)) {
            // 画像をアップロードする
            $image = $_FILES['image']['name'];
            $file= $_FILES['image'];
            $filepath = './img/'.$file['name'];
            $picture = move_uploaded_file($file['tmp_name'],$filepath);
            $_SESSION['join'] = $_POST;
            $_SESSION['join']['image'] = $filepath;
            header('Location: check.php');
            exit();
        }

        // if(empty($error)){
        //     $_SESSION['join'] = $_POST;
        //     $file= $_FILES['image'];
        //     $filepath = './img/'.$file['name'];
        //     $picture = move_uploaded_file($file['tmp_name'],$filepath);
        //     header('Location: check.php');
        //         exit();
        // }

    }
    if ($_REQUEST['action'] == 'rewrite'){
        $_POST = $_SESSION['join'];
        $error['rewrite'] = true;
    }
    // var_dump($_SESSION);
    // echo session_id();
?>

<!DOCTYPE html>
<html lang="ja">

<head>
<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>ユーザー登録</title>
    <link href="https://unpkg.com/sanitize.css"rel="stylesheet"/>
    <link  href="https://unpkg.com/sanitize.css/forms.css"  rel="stylesheet"/>
    <link  href="https://unpkg.com/sanitize.css/typography.css" rel="stylesheet"/>
	<link rel="stylesheet" href="./css/style.css" />
    </head>

<body>
    <div class="center">
        
        <h1>新規アカウントを登録</h1>
        <h2>登録して自分のコレクションを管理しよう</h2>
        <form action="" method="post" enctype="multipart/form-data">
        <dl>
        <div class="cp_iptxt">
            <input class="ef" type="text" name="name" size="35"  value="<?php echo htmlspecialchars($_POST['name'], ENT_QUOTES);?>" placeholder="">
            <label>ニックネーム</label>
            <span class="focus_line"></span>
                <?php if ($error['name'] == 'blank'): ?>
            <p class="error">ニックネームを入力してください</p>
            <?php endif; ?>
        </div>
            <!-- <?php if ($error['name'] == 'blank'): ?><span class="required"> 必須</span><?php endif; ?> -->
        <div class="cp_iptxt">
            <input class="ef" type="text" name="email" size="35"  value="<?php echo htmlspecialchars($_POST['email'], ENT_QUOTES);?>" placeholder="">
            <label>メールアドレス</label>
            <span class="focus_line"></span>
            <?php if ($error['email'] == 'blank'): ?>
            <p class="error">* メールアドレスを入力してください</p>
            <?php endif; ?>
            <?php if ($error['email'] == 'duplicate'): ?>
            <p class="error">* メールアドレスはすでに登録されています</p>
            <?php endif; ?>
        </div>
        <div class="cp_iptxt">
            <input class="ef" type="password" name="password" size="35"  value="<?php echo htmlspecialchars($_POST['password'], ENT_QUOTES);?>" placeholder="">
            <label>パスワード</label>
            <span class="focus_line"></span>
            <?php if ($error['password'] == 'blank'): ?>
            <p class="error">* パスワードを入力してください</p>
            <?php endif; ?>
            <?php if ($error['password'] == 'length'): ?>
            <p class="error">* 4文字以上で入力してください</p>
            <?php endif; ?>
        </div>
            <dt  class="small-p">写真など</dt>
            <dd><input type="file" name="image" size="35" class="textbox1 photo">
            <?php if($error['image'] =='type'):?>
            <p class="error">写真の拡張子はgifかjpg かpngでお願いします</p>
            <?php endif;?>
            </dd>

            <div class="flex2"><a href="login.php" class="reset flat border">アカウントをお持ちの方</a>
            <input type="submit" value="入力内容を確認する" class="reset flat border"></div>
        </form>
    </div>
</body>
</html>