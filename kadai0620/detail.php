<?php
$id = $_GET["id"];

include("funcs.php");  //funcs.phpを読み込む（関数群）
$pdo = db_conn();      //DB接続関数

//２．データ登録SQL作成
$stmt   = $pdo->prepare("SELECT*FROM nm_res_table WHERE id=:id"); //SQLをセット
$stmt->bindValue(':id',   $id,    PDO::PARAM_INT);
$status = $stmt->execute(); //SQLを実行→エラーの場合falseを$statusに代入

//３．データ表示
$view=""; //HTML文字列作り、入れる変数
if($status==false) {
  //SQLエラーの場合
  sql_error($stmt);
}else{
  //SQL成功の場合
  $row = $stmt->fetch(); // １つのデータを取り出して $row に格納
}

?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>おすすめ店</title>
    <link rel="stylesheet" href="./CSS/style.css">
</head>
<body>
    
<form method="post" action="update.php">
  <div class="jumbotron">
   <fieldset>
    <legend class="title">人におすすめしたい店</legend>
    <table>
     <tr>
      <th class="form-item"><label>店名：</th>
      <td class="form-body"><input type="text" name="name" value="<?=$row["name"]?>"></label><br></td>
     </tr>
     <tr>
     <th class="form-item"><label>場所：</th>
     <td class="form-body"><input type="text" name="place" value="<?=$row["place"]?>"></label><br></td>
     </tr>
     <tr>
     <th class="form-item"><label>予算：</th>
     <td class="form-body"><input type="text" name="price" value="<?=$row["price"]?>"></label><br></td>
     </tr>
     <tr>
     <th class="form-item"><label>目的：</th>
     <td class="form-body"><select name="perpose" value="<?=$row["perpose"]?>">
        <option value="会食・接待">会食・接待</option>
        <option value="歓送迎会">歓送迎会</option>
        <option value="若手飲み">若手飲み</option></label><br></td>
     </tr>
     <tr>
     <th class="form-item"><label>HP ：</th>
     <td class="form-body"><input type="text" name="link" value="<?=$row["link"]?>"></label><br></td>
     </tr>
     <tr>
     <th class="form-item"><label>おすすめポイント：</th>
     <td class="form-body"><textArea name="point" rows="4" cols="40" value="<?=$row["naiyou"]?>"></textArea></label><br></td>
     </tr>    
    </table>
    <!-- idを隠して送信 -->
    <input type="hidden" name="id" value="<?=$id?>">
    <input type="submit" value="送信">
    </fieldset>
  </div>
</form>

</body>
</html>