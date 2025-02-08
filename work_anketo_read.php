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





// --------------------------
// データ取得
// --------------------------

$array = [];
$parts = ["腕", "腹筋", "肩・胸", "太もも"];
$partCounts = array_fill_keys($parts, 0);

// echo "<pre>";
// var_dump($partCounts);
// exit();
// echo "</pre>";

$file = fopen("data/work_anketo_todo.txt", "r");

flock($file, LOCK_EX);

if ($file) {
    while ($line = fgets($file)) {

        $data = explode(" ", $line);

        // echo "<pre>";
        // var_dump($line);
        // var_dump($data[1]);
        // exit();


        if (isset($data[0], $data[1])) {
            $day = trim($data[0]);
            $part = trim($data[1]);

            // var_dump($part);
            // exit();

            if (in_array($part, $parts)) {
                $partCounts[$part]++;
            }

            // echo "<pre>";
            // var_dump($partCounts);
            // exit();

            // $arrayにデータを追加
            if (isset($partCounts[$part])) {
                $array[] = "<tr><td>" . htmlspecialchars($day) . "：" . htmlspecialchars($part) . "</td></tr>";
            }
        }
    }
}

// echo "<pre>";
// var_dump($array);
// exit();


flock($file, LOCK_UN);
fclose($file);



// データを取得
//decadeDataには値が入るようにしないと円グラフで表示できない！
$decadeData = array_values($partCounts);
$backgroundColor = ["#BB5179", "#daa520", "#58A27C", "#3C00FF"];
//$decadeDataにnullデータも入っているので、それは円グラフに表示不要なので除外
$labels = array_keys($partCounts);

// echo "<pre>";
// var_dump($decadeData);
// exit();


//※※※たろ先生フィードバック⇒無い場合０を入れる、1970年代は無いので、配列に0入れる作業必要


// PHPで取得したデータをJSの変数として使えるようにする
echo "<script>";
echo "let decadeData = " . json_encode($decadeData) . ";";
echo "let backgroundColor = " . json_encode($backgroundColor) . ";";
echo "let labels = " . json_encode($labels) . ";";
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
    /* 特定のidを持つ要素に対して*/
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
                <?= implode("", $array) ?>
            </tbody>
        </table>
    </fieldset>


    <h2>筋トレ部位日数</h2>
    <canvas id="myPieChart"></canvas>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.bundle.js"></script>
    <!-- ％用プラグインを読み込む -->
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@0.7.0/dist/chartjs-plugin-datalabels.min.js"></script>

    <script>
        var ctx = document.getElementById("myPieChart");

        console.log(decadeData);

        // データをフィルタリングして0の値を持つデータポイントを除外
        let filteredData = decadeData.filter(value => value > 0);
        let filteredBackgroundColor = backgroundColor.filter((color, index) => decadeData[index] > 0);
        let filteredLabels = labels.filter((label, index) => decadeData[index] > 0);

        var myPieChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: filteredLabels,
                datasets: [{
                    backgroundColor: filteredBackgroundColor,
                    data: filteredData
                }]
            },
            options: {
                responsive: false,
                plugins: {
                    datalabels: {
                        formatter: (value, ctx) => {
                            let sum = ctx.chart.data.datasets[0].data.reduce((a, b) => a + b, 0);
                            let percentage = (value * 100 / sum) + "%";
                            return percentage;
                        },
                        color: "#fff",
                    }
                },

                title: {
                    display: true,
                    text: '部位'
                }
            },
            plugins: [ChartDataLabels]
        });
    </script>

</body>

</html>