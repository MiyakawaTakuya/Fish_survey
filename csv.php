<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

</body>
<script>
    function putCsv($data) {
        try {
            //CSV形式で情報をファイルに出力のための準備
            $csvFileName = '/tmp/'.time().rand().
            '.csv';
            $fileName = time().rand().
            '.csv';
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
            header('Content-Disposition: attachment; filename='.$fileName);
            // ファイルのサイズ　ダウンロードの進捗状況が表示
            header('Content-Length: '.filesize($csvFileName));
            header('Content-Transfer-Encoding: binary');
            // ファイルを出力する
            readfile($csvFileName);
        } catch (Exception $e) {
            // 例外処理をここに書きます
            echo $e - > getMessage();
        }
    }

    putCsv($data);
</script>

</html>