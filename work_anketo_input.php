<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ストリートダンスリスト（入力画面）</title>
</head>

<body>
    <form action="work_anketo_create.php" method="POST">
        <fieldset>
            <legend>ストリートダンスリスト（入力画面）</legend>
            <a href="work_anketo_read.php">一覧画面</a>
            <div>
                ジャンル名: <input type="text" name="janru">
            </div>
            <div>
                誕生年: <input type="date" name="tanjo">
            </div>
            <div>
                <button>submit</button>
            </div>
        </fieldset>
    </form>

</body>

</html>