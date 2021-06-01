<?php
$str = "";   //変数定義
$data = [];  //空の配列を用意
// $data2 = [];

$file = fopen('data/choka.csv', 'r');
flock($file, LOCK_EX); // ファイルをロック

if ($file) {
  while ($line = fgets($file)) { // fgets()で1行ずつ取得→$lineに格納
    $str .= "<tr><td>{$line}</td></tr>"; // 取得したデータを$strに入れる .= は +=みたいな指示 }
    array_push($data, $line);  //JSONにしてJS使えるようにするため配列へ切り替えるため
  }
}
flock($file, LOCK_UN);
fclose($file);


?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>おまえらが釣った魚教えたるわ</title>

</head>
<style>
body{
  background:#1e50a2;
}
fieldset {
    border: none;
  }
  .all {
  display: flex;
  justify-content: center;
  align-items: center;
  flex-direction: column;
  height: 100%;
  color:white;
  }



</style>

<body>
<div class="all">
  <fieldset>
    <legend>おまえらが釣った魚教えたるわ</legend>
    
    <table>
      <thead>
        <tr>
          <th>釣果</th>
          <!-- <br><th>日時, 釣り人, 魚, 大きさ, その時の気分</th> -->
          <th><?= $str ?></th>
        </tr>
      </thead>
      <tbody>
      </tbody>
    </table>
    <a href="data/choka.csv.php">
    <button>csv Download</button></a>
    <a href="choka_csv_input.php"><button>釣果入力画面へ</button></a>
    <a href="choka_csv_input.php"><button>結果発表</button></a>
  </fieldset>
</div>

  <script>
    const hoge = <?= json_encode($data) ?>;
    const data = hoge.map(x => {
      return {
        data: x.split(' ')[0],
        todo: x.split(' ')[1].split('\n').join(','),
        // todo: x.split(' ')[1].split('\n'),
        // todo: x.split(' ')[1],
      }
    })
    console.log(data);


function putCsv($data) {
    try {
        //CSV形式で情報をファイルに出力のための準備
        $csvFileName = '/tmp/' . time() . rand() . '.csv';
        $fileName = time() . rand() . '.csv';
        $res = fopen($csvFileName, 'w');
        if ($res === FALSE) {
            throw new Exception('ファイルの書き込みに失敗しました。');
        }
        // 項目名先に出力
        $header = ["Date", "Name", "FishName", "HowBig"];
        fputcsv($res, $header);
        // ループしながら出力
        foreach($data as $dataInfo) {
            // 文字コード変換。エクセルで開けるようにする
            mb_convert_variables('SJIS', 'UTF-8', $dataInfo);
            // ファイルに書き出しをする
            fputcsv($res, $dataInfo);
        }
        // ファイルを閉じる
        fclose($res);
        // ダウンロード開始
        // ファイルタイプ（csv）
        header('Content-Type: application/octet-stream');
        // ファイル名
        header('Content-Disposition: attachment; filename=' . $fileName); 
        // ファイルのサイズ　ダウンロードの進捗状況が表示
        header('Content-Length: ' . filesize($csvFileName)); 
        header('Content-Transfer-Encoding: binary');
        // ファイルを出力する
        readfile($csvFileName);
    } catch(Exception $e) {
        // 例外処理をここに書きます
        echo $e->getMessage();
    }
}

putCsv($data);

  </script>
</body>

</html>