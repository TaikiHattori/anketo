<?php
// var_dump($_POST);
// exit();

// ↑データ受け取りチェックOK
// OKならvar_dumpとexitコメントアウト


$janru = $_POST["janru"];
$tanjo = $_POST["tanjo"];



// ↓講義では空欄になってますよ警告ver.
// 数値が間違えて入力された場合のチェック
if (is_numeric($janru)) {
    // 数値が入力された場合はエラーメッセージを表示して処理を終了
    echo "数値は入力できません。";
    exit();
}



// 文字列の長さが17字以上であるかをチェック
if (mb_strlen($janru) >= 17) {
    // 17文字以上の場合はエラーメッセージを表示して処理を終了
    echo "16文字以内で入力してください。";
    exit();
}


// ↓反応なかった
// if (mb_strlen($_SESSION["name"]) > 6) {
//     array_push($errorText, "名前は6文字以内で入力してください。");
//     $error++;
// };



// ↓反応なかった
// 半角文字が入力された場合のチェック
// if (preg_match('/[!-~]/', $janru)) {
//     // 半角文字が含まれている場合はエラーメッセージを表示して処理を終了
//     echo "全角で入力してください。";
//     exit();
// }


//ここの'/[^\x01-\x7E]/'は全角ひらがな含むので、||が必要だった
// ↑から一旦避難させたpreg_match('/[^\x01-\x7E]/', $janru) || 



// // ひらがなが入力された場合のチェック！！
// if (!preg_match('/^[ァ-ヶー]+$/u', $janru)) {
// //     // カタカナでない場合はエラーメッセージを表示して処理を終了
//     echo "カタカナで入力してください。";
//     exit();
// }


// exitの位置工夫

// // メールアドレスに@が含まれているかチェック！！
// if (strpos($janru, '@') !== false) {
// //     // メールアドレスが含まれている場合はエラーメッセージを表示して処理を終了
//     echo "メールアドレスは入力しないでください。";
//     exit();
// }











// 半角文字が入力された場合のチェック
// if (preg_match('/[^\x01-\x7E]/', $janru) ) {
//     // 半角文字が含まれている場合はエラーメッセージを表示して処理を終了
//     echo "全角で入力してください。";
//     exit();
// }







// ひらがなが入力された場合のチェック
// if (preg_match('/^[ぁ-んー]+$/u', $janru)) {
//     // ひらがなでない場合はエラーメッセージを表示して処理を終了
//     echo "カタカナで入力してください。";
//     exit();
// }














// ↑↑↑正しく入力できた場合のみ、以下のファイル書き込み処理へと進む



// ↓ファイルに書き込み
// 書き込みたいデータの作成
$write_data = "{$tanjo} {$janru}\n";
// ↑{$tanjo}と{$todo}の間に半角スペース
// ↑\nしないと改行されずにデータがとんでもなく横長になってしまう



// ↓以下はほぼ毎回同じ

// ファイルを開く
$file = fopen("data/work_anketo_todo.txt", "a");
// aを書くと新しいフォルダーを作ってくれる
// dataフォルダにwork_anketo_todo.txtファイルを作るという意味


// ファイルをロックする。他人に編集されないように
flock($file, LOCK_EX);
// // ↑LOCK_EXが白色で反応してないように見えるが反応してる


// // ファイルにデータを書き込む
fwrite($file, $write_data);


// ロック解除
flock($file, LOCK_UN);
// // ↑LOCK_UNが白色で反応してないように見えるが反応してる



// // ファイルを閉じる
fclose($file);
// // ↑毎回ほぼ同じ


// // todo_txt_input.phpに移動する
header("Location:work_anketo_input.php");
exit();

// macの人は権限変更必要

// ここまで書いたら、dataフォルダ内のwork_anketo_todo.txtファイルに入力データ保存されたかチェック
// 保存されてたらOK
// AM講義終了