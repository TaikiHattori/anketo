<?php
// var_dump($_POST);
// exit();
// データ受け取れたかチェック↑
// それをxamppブラウザで確認
// データ全体からほしいものを取得する
// 受け取りチェックできたらコメントアウト


$todo = $_POST["todo"];
$deadline = $_POST["deadline"];


?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>todo表示画面（POST）</title>
</head>

<body>
  <fieldset>
    <legend>todo表示画面（POST）</legend>
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