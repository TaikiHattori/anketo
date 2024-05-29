<?php
$str = "";
// ↑1.文字列に追加ver.
$array = [];
// ↑2.配列に追加ver.

// ↓以下はほぼ毎回同じ
// ファイルを開く
$file = fopen("data/work_anketo_todo.txt", "r");
// rは という意味

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
        $array[] = "<tr><td>{$line}</td></tr>";


        // $array[] = [
        //     "janru" => explode("", $line)[1],
        //     "tanjo" => explode("", $line)[0],
        // ];
    }
}

// ↑作りたいものによってここに変化が生まれる

// ロック解除
flock($file, LOCK_UN);
// ↑LOCK_UNが白色で反応してないように見えるが反応してる


// ファイルを閉じる
fclose($file);
// 配列の要素を空文字で連結して文字列にする

// ↑毎回ほぼ同じ



// ↓work_anketo_todo.txtに保存したデータがXAMPPブラウザに表示されるかチェック
// ↓表示されたのでコメントアウト
// ↓ここまでが表示されたということはここまでは合ってる
// var_dump($array);
// exit();


// --------------------------
// ↑↑↑講義と同じ内容
// --------------------------












// -----------------------------------------
// 年データ取得
// --------------------------


$years = []; // 年のデータを格納する配列

// ファイルを開く
$file = fopen("data/work_anketo_todo.txt", "r");

flock($file, LOCK_EX);

// ファイルからデータを取り出す
if ($file) {
    while ($line = fgets($file)) {

        // 年の部分を取得して配列に追加
        $parts = explode(" ", $line);
        $year = explode("-", $parts[0])[0];
        // ↑$partsで[年-月-日テキスト]を[年-月-日 テキスト]に分割。
        //$yearsで[年-月-日 テキスト]の0番目である「年-月-日」のさらに中の0番目の「年」を取得

        $years[] = $year;
    }
}


flock($file, LOCK_UN);

// ファイルを閉じる
fclose($file);


// var_dump($years);
// exit();
// ↑「年」だけ取得できてるかチェックOK



// // PHPで取得した年のデータをJavaScriptに渡す
// ↓※これないと円グラフ表示されない
// echo "<script>let years = " . json_encode($years) . ";</script>";








// --------------------------
// ↓↓↓同じ年代を円グラフ上で同じ色にする2
// --------------------------

// 年代ごとにデータを集計する
$decadeCounts = []; // 年代ごとのデータを格納する配列
foreach ($years as $year) {

    // $decade = substr($year, 0, 3) . "0年代"; // 年代を求めるver.1

    // 年代を求めるver.2
    $decade = floor($year / 10) * 10 . "年代"; // 年から年代を求める



    if (!isset($decadeCounts[$decade])) {
        $decadeCounts[$decade] = 0;
    }
    $decadeCounts[$decade]++;
}

// 年代ごとの色分けを定義
$backgroundColor = [
    "#BB5179", // 赤
    "#FAFF67", // 黄色
    "#58A27C", // 緑
    "#3C00FF" // 青
];

// 年代ごとのデータを取得
$decadeData = array_values($decadeCounts);

// JavaScriptの円グラフのデータと色分けを設定
echo "<script>";
echo "let decadeData = " . json_encode($decadeData) . ";";
echo "let backgroundColor = " . json_encode($backgroundColor) . ";";
echo "</script>";




// var_dump($decadeCounts);
// exit();
// ↑array(2) { ["1960年代"]=> int(4) ["2020年代"]=> int(1) }
//と出たので、1960年代4個、2020年代1個でチェックOK



// var_dump($decadeData);
// exit();
// ↑array(2) { [0]=> int(4) [1]=> int(1) }
//と出たので、[0]4個、[1]1個で取得できてる




// var_dump($decade);
// exit();
// ↑string(10) "2020年代"と取得できてるOK








// --------------------------
// ↓↓↓同じ年代を円グラフ上で同じ色にする1
// --------------------------

// 年代ごとにデータを集計する
// $yearCounts = array_count_values($years);

// // 年代ごとのデータを取得
// $yearData = [];
// foreach ($yearCounts as $year => $count) {
//     $yearData[] = $count;
// }

// // 年代ごとの色分け
// $backgroundColor = [
//     "#BB5179", //赤
//     "#FAFF67", //ピンク
//     "#58A27C", //緑
//     "#3C00FF" //青
// ];



// // 円グラフを描画するためのJavaScript
// echo "<script>";
// echo "let yearData = " . json_encode($yearData) . ";";
// echo "let backgroundColor = " . json_encode($backgroundColor) . ";";
// echo "</script>";




// var_dump();
// exit();






















// ---------------------------------------------------
// ジャンルデータ取得 ※一旦保留※PHPで取得した「janru」のデータをJavaScriptに渡さななのでは
// ---------------------------------------------------

// 「janru」のデータを格納する配列を定義
// $janrus = [];

// // ファイルを開く
// $file = fopen("data/work_anketo_todo.txt", "r");

// flock($file, LOCK_EX);

// // ファイルからデータを取り出す
// if ($file) {
//     while ($line = fgets($file)) {
//         // スペースで区切って「janru」のデータを取得
//         $parts = explode(" ", $line);
//         $janru = $parts[1]; // 「janru」のデータは配列の2番目にあると仮定。ん？
//         $janrus[] = $janru;
//     }
// }


// flock($file, LOCK_UN);

// // ファイルを閉じる
// fclose($file);

// // PHPで取得した「janru」のデータをJavaScriptに渡す
// echo "<script>let janrus = " . json_encode($janrus) . ";</script>";
















?>
<!-- ↑htmlも書くなら?>を忘れるな -->













<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ストリートダンスリスト（一覧画面）</title>
</head>

<body>
    <fieldset>
        <legend>ストリートダンスリスト（一覧画面）</legend>
        <a href="work_anketo_input.php">入力画面</a>
        <table>
            <thead>
                <tr>
                    <th>誕生年</th>
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













    <h2>円グラフ</h2>
    <canvas id="myPieChart"></canvas>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.bundle.js"></script>



    <!-- -------------------------------------------------- -->
    <!-- Chart.jsのData Labelsプラグインを使用して円グラフの中にデータを表示する -->
    <!-- --------------------------------------------------------------------- -->

    <!-- <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script> -->







    <script>
        // -------------------------------------------------------------
        // ↓↓↓同じ年代を円グラフ上で同じ色にする2※ 保留
        // -----------------------------------------------------------



        // var ctx = document.getElementById("myPieChart");
        // var myPieChart = new Chart(ctx, {
        //     type: 'pie',
        //     data: {
        //         labels: Object.keys(decadeCounts),
        //         datasets: [{
        //             backgroundColor: backgroundColor,
        //             data: decadeData
        //         }]
        //     },
        //     options: {
        //         title: {
        //             display: true,
        //             text: '誕生年'
        //         }
        //     }
        // });











        // ※※※2024年が1970年代カウントされてしまっている※※※












        // ---------------------------------------------------------
        // 円グラフ元々の「data: [1,1,1,1]」だけを改造
        // -------------------------------------------------


        var ctx = document.getElementById("myPieChart");
        var myPieChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: ["1960年代", "1970年代", "1980年代", "1990年代", "2000年代", "2010年代", "2020年代"],
                datasets: [{
                    backgroundColor: [
                        "#BB5179",
                        "#FAFF67",
                        "#58A27C",
                        "#3C00FF",
                        "#66cdaa",
                        "#87ceeb",
                        "#ffa500",

                    ],
                    data: decadeData
                    // ここ「data: decadeData」で.txtファイルの保存データの「年」と円グラフが連動した
                    // ↑GPTで出なかった


                }]
            },
            options: {
                title: {
                    display: true,
                    text: '誕生年'
                }
            }
        });

        // ---------------------------------------------------------
        // 円グラフ元々の「data: [1,1,1,1]」だけを改造
        // -----------------------------------------------







        // let ctx = document.getElementById("myPieChart");
        // let myPieChart = new Chart(ctx, {
        // type: 'pie',
        // data: {
        // // labels: Object.keys(yearCounts),
        // labels: years, //年のデータをラベルとして使用
        // datasets: [{

        // // data: yearData,
        // // backgroundColor: backgroundColor

        // backgroundColor: [
        // "#BB5179",
        // "#FAFF67",
        // "#58A27C",
        // "#3C00FF"
        // ],


        // data:[1,1,1,1]

        // // data: Array(years.length).fill(1) // 年の数だけ1を持つ配列を生成
        // }]
        // },
        // options: {
        // title: {
        // display: true,
        // text: '誕生年'
        // }



        // // Chart.jsのData Labelsプラグインを追加↓
        // // plugins: {
        // // datalabels: {
        // // color: '#000000', // ラベルの文字色⇒黒
        // // formatter: function(value, context) {
        // // // ラベルに表示するデータを指定
        // // return years[context.dataIndex];
        // // }
        // // }
        // // }
        // }


        // });
    </script>

</body>

</html>