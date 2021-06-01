<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>釣った魚どんなもん？</title>
</head>
<style>
body{
  background:#1e50a2;
}
  .all {
  display: flex;
  justify-content: center;
  align-items: center;
  flex-direction: column;
  height: 100%;
  color:white;
  }

  fieldset {
    border: none;
  }
  .form {
    /* color: goldenrod; */
    font-size:18px;
    margin:4px;
  }
  input{
      color:white;
  }
  select{
    color:white;
  }
  .box {
    background-color:#007bbb;
    opacity: 80%;
    border-radius:8px;
  }

  .button {
  width:100%;
  display: flex;
  justify-content: center;
  font-size:18px;
  margin:4px;
  }
  .href {
  font-size:12px;
  margin-top:24px;
  }

</style>

<body>
<div class="all">
  <form action="choka_csv_create.php" method="post">
    <fieldset input-box>
      <legend>釣った魚どんなもん？</legend>
      <div class="form">
        Fisherman <input type="text" name="Fisherman" class="box" id="Fisherman">
      </div>
      <div class="form">
        Fish Name <input type="text" name="fishname" class="box" id="fishname">
      </div>
      <div class="form">
        How Big? <input type="text" name="howbig" class="box" id="howbig"> cm
      </div>
      <div class="form">
        Your Tension <select name="tension" label="良好" class="box">
        <option value="最高！">最高！</option>
        <option value="良好！">良好！</option>
        <option value="まあまあ">まあまあ</option>
        <option value="まだまだ">まだまだ</option>
        <option value="次行きます！">次行きます！</option>
        <option value="大物狙います！">大物狙います！</option>
        <option value="早く食べたい">早く食べたい</option>
        <option value="ちょっと休憩">ちょっと休憩</option>
        <option value="帰りたい">帰りたい</option>
        </select>
      </div>
      <div class="button" class="box">
      <button id="Register">Register</button>
      <p id="error_comment_1"></p>
      </div>
      <div class="href">
      <a href="choka_csv_read.php">釣果一覧へ</a>
      </div >
    </fieldset>
  </form>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
//inputのが全部埋まってないとRefisterできないようにする
  $('#Register').on('click', function () {
    const signUp_data_1 =  $('#Fisherman').val();
    const signUp_data_2 =  $('#fishname').val();
    const signUp_data_3 =  $('#howbig').val();
        if (signUp_data_1  != "" && signUp_data_2  != "" && signUp_data_3 != "" ) {
          $('#error_comment_1').text('');
        } else {
          $('#error_comment_1').text('Please fill box');
        } 
  });
</script>
</body>

</html>