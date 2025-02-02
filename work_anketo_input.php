<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>筋トレ（入力画面）</title>
</head>

<body>
    <form action="work_anketo_create.php" method="POST">
        <fieldset>
            <legend>筋トレ（入力画面）</legend>

            <div>
                筋トレ日: <input type="date" name="tanjo">
            </div>
            <div>
                部位: <input type="text" name="janru">
            </div>

            <div>
                <button>登録</button>
            </div>
        </fieldset>
    </form>

    <a href="work_anketo_read.php">一覧画面へ</a>

</body>

</html>