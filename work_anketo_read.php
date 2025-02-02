<?php

// --------------------------
// 講義
// --------------------------
// 1.文字列に追加ver.
// $str = "";

// // 2.配列に追加ver.
// $array = [];

// // ↓以下ほぼ毎回同じ

// // ファイルを開く
// $file = fopen("data/work_anketo_todo.txt", "r");

// // ファイルをロックする。他人に編集されないように
// flock($file, LOCK_EX);

// // ファイルからデータを取り出す
// if ($file) {
//     while ($line = fgets($file)) {
//         // 文字列に追加ver.（作りたいものによってここに変化が生まれる）
//         $str .= "<tr><td>{$line}</td></tr>";

//         // 配列に追加ver.（作りたいものによってここに変化が生まれる）
//         $array[] = "<tr><td>{$line}</td></tr>";

//     }
// }

// // ロック解除
// flock($file, LOCK_UN);


// // ファイルを閉じる
// fclose($file);

// ↑毎回ほぼ同じ


// var_dump($array);
// exit();


// --------------------------
// ↑↑↑講義
// --------------------------





// -----------------------------------------
// 年データ取得
// --------------------------

$array = [];
$parts = [];
$partCounts = array_fill_keys($parts, 0);

$file = fopen("data/work_anketo_todo.txt", "r");

flock($file, LOCK_EX);

if ($file) {
    while ($line = fgets($file)) {
        $data = explode(",", $line);

        //$arrayにデータを追加
        $array[] = "<tr><td>{$line}</td></tr>";
    }
}


flock($file, LOCK_UN);

fclose($file);


// // PHPで取得した年のデータをJavaScriptに渡す
// ※これないと円グラフ表示されない




// 年代ごとの色分けを定義
$backgroundColor = [
    "#BB5179", // 赤
    "#FAFF67", // 黄色
    "#58A27C", // 緑
    "#3C00FF" // 青
];

// 年代ごとのデータを取得
$decadeData = array_values($partCounts);



//※※※たろ先生フィードバック⇒無い場合０を入れる、1970年代は無いので、配列に0入れる作業必要


// JavaScriptの円グラフのデータと色分けを設定
echo "<script>";
echo "let decadeData = " . json_encode($decadeData) . ";";
echo "let backgroundColor = " . json_encode($backgroundColor) . ";";
echo "</script>";



?>
<!-- ↑htmlも書くなら「?>」必要 -->



<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>筋トレ（一覧画面）</title>
</head>

<style>
    /* 特定のidを持つ要素に対してCSSを適用する際に「#」使う */
    #myPieChart {
        width: 600px;
        height: 600px;
    }
</style>

<body>
    <fieldset>
        <legend>筋トレ（一覧画面）</legend>
        <a href="work_anketo_input.php">入力画面へ</a>
        <table>
            <thead>
                <tr>
                    <th>筋トレ部位</th>
                </tr>
            </thead>
            <tbody>
                <!-- json_encode($array)  -->
                <!-- ↑「$array」だけを?で挟んで書くと「Warning: Array to string conversion in C:\Users\Taiki Hattori\Desktop\xampp\htdocs\G'sPHP講義\06_php01_sample\work_anketo_read.php on line 81
                Array」というエラーが出る。
                これはJSではPHPの配列を扱えないので出たエラー。
                ⇒サーバー上でJSON形式に変換する必要あり。
                だが、implode関数でうまくいった。-->

                <?= implode("", $array) ?>
                <!-- ↑配列も使って進めたなら、implodeで文字列変換必要 -->
            </tbody>
        </table>
    </fieldset>


    <h2>筋トレ部位割合</h2>
    <canvas id="myPieChart"></canvas>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.bundle.js"></script>

    <script>
        var ctx = document.getElementById("myPieChart");
        var myPieChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: ["腕", "腹筋", "肩・胸", "太もも"],
                datasets: [{
                    backgroundColor: [
                        "#BB5179",
                        "#FAFF67",
                        "#58A27C",
                        "#3C00FF",
                    ],
                    data: decadeData
                    // ここ「data: decadeData」で.txtファイルの保存データの「年」と円グラフが連動した
                    // ↑GPTで出なかった


                }]
            },
            options: {
                responsive: false,

                title: {
                    display: true,
                    text: '部位'
                }
            }
        });
    </script>

</body>

</html>