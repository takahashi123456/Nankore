<?php require('dbconnect.php');?>


<body class="text-center">
    
<main class="form-signin">
    <form>
        <img class="mb-4" src="../img/logo.svg" alt="" width="72" height="57">
        <h1 class="h3 mb-3 fw-normal">サインインする</h1>
        <label for="inputEmail" class="visually-hidden">メールアドレス</label>
        <input type="email" id="inputEmail" class="form-control" placeholder="メールアドレス" required autofocus>
        <label for="inputPassword" class="visually-hidden">パスワード</label>
        <input type="password" id="inputPassword" class="form-control" placeholder="パスワード" required>
        <div class="checkbox mb-3">
        <label>
            <input type="checkbox" value="remember-me"> 記憶する
        </label>
    </div>
    <button class="w-100 btn btn-lg btn-primary" type="submit">サインイン</button>
        <p class="mt-5 mb-3 text-muted">&copy; 2021-中間sample</p>
    </form>
</main>


  </body>
</html>