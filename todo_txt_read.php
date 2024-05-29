<?php
$str = "";
// ↑1.文字列に追加ver.

// $array =[];
// ↑2.配列に追加ver.



// ↓以下はほぼ毎回同じ

// ファイルを開く
$file = fopen("data/todo.txt", "r");
// rを書くと
// という意味


// ファイルをロックする。他人に編集されないように
flock($file, LOCK_EX);
// ↑LOCK_EXが白色で反応してないように見えるが反応してる




// ファイルからデータを取り出す！！
if ($file) {
  while ($line = fgets($file)) {
    // 文字列に追加ver.
    // .=はJSでいう+= 一個ずつ足していくという意味
    $str .= "<tr><td>{$line}</td></tr>";

    // 配列に追加ver.
    // $array[] = "<tr><td>{$line}</td></tr>";
  }
}

// ↑ここが変化が生まれる




// ロック解除
flock($file, LOCK_UN);
// ↑LOCK_UNが白色で反応してないように見えるが反応してる


// ファイルを閉じる
fclose($file);
// 配列の要素を空文字で連結して文字列にする

// ↑毎回ほぼ同じ





?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>textファイル書き込み型todoリスト（一覧画面）</title>
</head>

<body>
  <fieldset>
    <legend>textファイル書き込み型todoリスト（一覧画面）</legend>
    <a href="todo_txt_input.php">入力画面</a>
    <table>
      <thead>
        <tr>
          <th>todo</th>
        </tr>
      </thead>
      <tbody>
        <?= $str ?>


        <!-- ↑配列から表示するなら、implodeで文字列変換必要 -->
      </tbody>
    </table>
  </fieldset>
</body>

</html>