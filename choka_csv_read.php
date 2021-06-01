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
  body {
    background: #1e50a2;
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
    color: white;
  }
</style>

<body>
  <div class="all">
    <fieldset>
      <legend>釣果</legend>

      <table>
        <thead>
          <tr>
            <th>日時, 釣り人, 魚, 大きさ, その時の気分</th>
            <!-- <br><th>日時, 釣り人, 魚, 大きさ, その時の気分</th> -->
            <th><?= $str ?></th>
          </tr>
        </thead>
        <tbody>
        </tbody>
      </table>
      <a href="/csv.php">
        <button>csv Download</button></a>
      <a href="choka_csv_input.php"><button>釣果入力画面へ</button></a>
      <!-- <a href="result.php"><button>結果発表</button></a> -->
      <a id="result_up"><button>結果発表</button></a>
      <p id="result"></p>
      <p id="result2"></p>
    </fieldset>
  </div>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script>
    const hoge = <?= json_encode($data) ?>;
    console.log(hoge);
    const data = hoge.map(x => {
      return {
        day: x.split(' ')[0],
        time: x.split(' ')[1],
        fisherman: x.split(',')[1],
        fishname: x.split(',')[2],
        howbig: x.split(',')[3],
        tension: x.split(',')[4].split('\n').join(','),
        // fishname: x.split(' ')[3],
        // howbig: x.split(' ')[4].split('\n').join(','),
        // tension: x.split(' ')[5].split('\n').join(','),
      }
    });
    console.log(data);
    console.log(data[2]);
    console.log(data.length);
    // const SavaCou = data.fishname.val();
    // console.log(SavaCou);
    // for (let i = 0; i < c1.length; i++) {
    //   console.log(c1[i]); // 
    // }
    const SavaCou = data.length;
    console.log(SavaCou);
    //結果発表のコメントらん
    $('#result_up').on('click', function() {
      if (SavaCou >= 10) {
        $('#result').text("あたなが釣ったサバの数は " + SavaCou + "匹だにゃ!"); //変数だから””はいらない
        $('#result2').text("あたなはKing of SAVA だにゃ！"); //変数だから””はいらない
      } else if (SavaCou >= 1) {
        $('#result').text("あたなが釣ったサバの数は " + SavaCou + "匹だにゃ!"); //変数だから””はいらない
      } else if (SavaCou == 0) {
        $('#result').text("あたなが釣ったサバの数は " + SavaCou + "匹だにゃ!"); //変数だから””はいらない
        $('#result2').text("お前はただのぼうすだにゃ！"); //変数だから””はいらない
      }
    });
  </script>
</body>

</html>