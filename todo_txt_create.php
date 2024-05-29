<?php
// var_dump($_POST);
// exit();

// ↑データ受け取りチェック


$todo = $_POST["todo"];
$deadline = $_POST["deadline"];


// ↓ファイルに書き込み
// 書き込みたいデータの作成
$write_data = "{$deadline} {$todo}\n";
// ↑\nしないと改行されずにデータがとんでもなく横長になってしまう



// ↓以下はほぼ毎回同じ

// ファイルを開く
$file = fopen("data/todo.txt", "a");
// aを書くと新しいフォルダーを作ってくれる
// dataフォルダにtodo.txtファイルを作るという意味


// ファイルをロックする。他人に編集されないように
flock($file, LOCK_EX);
// ↑LOCK_EXが白色で反応してないように見えるが反応してる


// ファイルにデータを書き込む
fwrite($file, $write_data);


// ロック解除
flock($file, LOCK_UN);
// ↑LOCK_UNが白色で反応してないように見えるが反応してる



// ファイルを閉じる
fclose($file);
// ↑毎回ほぼ同じ


// todo_txt_input.phpに移動する
header("Location:todo_txt_input.php");
exit();

// macの人は権限変更必要

// ここまで書いたら、dataフォルダ内のtodo.txtファイルに入力データ保存されたかチェック
// 保存されてたらOK
// AM講義終了