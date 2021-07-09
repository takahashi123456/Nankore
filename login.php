<?php require('post/dbconnect.php');

    session_start();

    //クッキー等の処理

$count = 0;

    if(!empty($_POST)){
        if($_POST['email'] != '' && $_POST['password'] != ''){
            $Login = $db->prepare('SELECT * FROM members WHERE email=? AND password=?');
            $Login->execute(array(
                $_POST['email'],
                sha1($_POST['password'])
            ));
            $member =$Login->fetch();//入力した値がデータベースにあったときtrueになる（と思う）

            if($member){
            $_SESSION['id'] = $member['id'];
            $_SESSION['time'] = time();
            
            header('Location: ./post/index.php');
            exit();
            }else{
            $error['login'] = 'failed';
            $count = $count + 1;
            }
        }else{
            $error['login'] = 'blank';
            $count = $count + 1;
        }
    }
    
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>LOGIN</title>
    <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <link rel="canonical" href="https://getbootstrap.jp/docs/5.0/examples/sign-in/"> 
    <!-- Bootstrap core CSS -->
    <link href=https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css rel="stylesheet" 
    integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">



<!-- Custom styles for this template -->
    <link href="./css/signin.css" rel="stylesheet">
</head>
</head>
<!-- 
<body>
    <h1>LOGIN画面です</h1>
    <div class="lead">
    <p>メールアドレスとパスワードを記入してログインしてください</p>
    <p>入会手続きがまだの方はこちらからどうぞ</p>
    <p>&raquo; <a href="index.php">会員登録をする</a></p>
    </div> -->

<main class="form-signin text-center">
    <form method="POST">
        <img class="mb-4" src="img/logo.svg" alt="" width="72" height="57">
        <h1 class="h3 mb-3 fw-normal">サインインする</h1>
        <label for="inputEmail" class="visually-hidden">メールアドレス</label>
        <input type="email" id="inputEmail" name="email" class="form-control" placeholder="メールアドレス" value="<?php echo htmlspecialchars($_POST['email'], ENT_QUOTES); ?>" required autofocus>
        <?php if($error['login'] = 'failed' && $count == 1) :?>
        <p>正しいパスワードとメールアドレスを入力してください</p>
        <?php endif; ?>
        <?php if($error['login'] = 'blank' && $count == 2) :?>
        <p>文字を入力してください</p>
        <p><?php echo $count; ?></p>
        <?php endif; ?>
        <label for="inputPassword" class="visually-hidden">パスワード</label>
        <input type="password" id="inputPassword" name="password" class="form-control" placeholder="パスワード" required>
        <div class="checkbox mb-3">
        <label>
            <input type="checkbox" value="remember-me"> 記憶する
        </label>
    </div>
    <button class="w-100 btn btn-lg btn-primary" type="submit">サインイン</button>
        <p class="mt-5 mb-3 text-muted">&copy; 2021-中間sample</p>
        <p class="mt-5 mb-3 text-muted"><a href="index.php">会員登録をする</a></p>
            <!-- ログイン情報の保持 -->
    <?php 
        if($_POST['save'] == "on"){
            setcookie('email' , $_POST['email'], time()+60*60*24*14);
            setcookie('passwordß' , $_POST['password'], time()+60*60*24*14);

        }
    ?>
    </form>
</main>



    <?php 


    ?></div>

</body>

</html>