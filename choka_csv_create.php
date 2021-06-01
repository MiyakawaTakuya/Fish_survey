<?php
// var_dump($_POST);
// exit();
// $date = date("Y/m/d H:i:s");  //日時取得
$date = date("m/d H:i");  //日時取得
$Fisherman = $_POST["Fisherman"];   //データ受け取り
$fishname = $_POST["fishname"];   //データ受け取り
$howbig = $_POST["howbig"];   //データ受け取り
$tension = $_POST["tension"];   //データ受け取り

$write_data = "{$date},{$Fisherman},{$fishname},{$howbig},{$tension}\n";   //カンマ区切りで最後に改行

$file = fopen('data/choka.csv', 'a');   //ファイルを開く 引数a
// $file = fopen('data/todo2.txt', 'a');
flock($file, LOCK_EX);   //ファイルをロック
fwrite($file, $write_data);   //データを書き込み
flock($file, LOCK_UN);   //ロック解除
fclose($file);  //ファイルを閉じる

header("Location:choka_csv_input.php");  //入力画面へ移動
