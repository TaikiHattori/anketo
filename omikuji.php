<?php
// ↑これ以下からコメント書いていい

$randomNumber = rand(0, 4);

if ($randomNumber === 0) {
    $result = "大吉";
} else if ($randomNumber === 1) {
    $result = "中吉";
} else if ($randomNumber === 2) {
    $result = "小吉";
} else if ($randomNumber === 3) {
    $result = "凶";
} else {
    $result = "大凶";
}



// ↓if条件分岐を配列で書く場合
// $result =["大吉","中吉","小吉","凶","大凶"][$randomNumber];

// ↓htmlとかPHP以外も書くときは忘れるな
?>


<!-- ここまでPHP -->


<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <!-- 追加 -->
    <style>
        .result {
            color: red;
        }
    </style>
</head>

<body>
    <h1>おみくじの結果は<span class="result"><?= $result ?></span>です！</h1>

</body>

</html>