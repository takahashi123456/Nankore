<?php 
try{
    $db = new PDO('mysql:dbname=nankore;host=localhost;charset=utf8', 'root',"root");
    }catch(PDOException $e){
    echo 'DB接続エラー：'. $e->getMessage();
    }
    ?>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <link rel="canonical" href="https://getbootstrap.jp/docs/5.0/examples/sign-in/"> 
    <!-- Bootstrap core CSS -->
    <link href=https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css rel="stylesheet" 
    integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">



<!-- Custom styles for this template -->
    <!-- <link href="signin.css" rel="stylesheet"> -->
</head>