<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>

<body>
    <h1>最初のHTML</h1>
    <div><?php 
    for($i=1;$i<100;$i++){
        if($i % 3 ==0 && $i % 5 == 0){
            echo "fizzbuzz";
            echo "<br>";
        }else if($i % 3 ==0){
            echo 'fizz';
            echo "<br>";
        }else if($i % 5 ==0 ){
            echo 'buzz';
            echo "<br>";
        }else{
            echo $i;
            echo "<br>";
        }
    }


    ?></div>

</body>

</html>