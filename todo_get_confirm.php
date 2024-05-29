<?php
// var_dump($_GET);
// exit();
// ↑データ受け取りチェック
// それをxamppブラウザで確認
// データ全体からほしいものを取得する
// 受け取りチェックできたらコメントアウト

// ⇒var_dumpとexitで受け取りが上手くいってなかったら送り側のコードがミスってるはず
// 今回で言うとtodo_get.php側のコードがミスってるはず




// 送り方を表すmethod２種類あって、GETとPOST
// 「GETとPOSTの違い」
// GETは受け取ったデータを表示するブラウザのURLに入力したデータが表示される
// 今回で言うとtodo_get_confirm.phpのブラウザURLに表示される
// ログインでパスワード入力とかはGET使わんほうがいい


// POSTは受け取ったデータを表示するブラウザのURLに入力したデータが表示されない
// 今回で言うとtodo_post_confirm.phpのブラウザURLには表示されない
// ログインでパスワード入力とかはPOST使ったほうがいい



$todo = $_GET["todo"];
$deadline = $_GET["deadline"];


?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>todo表示画面（GET）</title>
</head>

<body>
  <fieldset>
    <legend>todo表示画面（GET）</legend>
    <table>
      <thead>
        <tr>
          <th>todo</th>
          <th>deadline</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td><?= $todo ?></td>
          <td><?= $deadline ?></td>
          <!-- ↑イコールを?にくっつけんと反応せん -->

        </tr>
      </tbody>
    </table>
  </fieldset>
</body>

</html>