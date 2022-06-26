<?php
include("funcs.php");  //funcs.phpを読み込む（関数群）
$pdo = db_conn();      //DB接続関数

// try {
//   //Password:MAMP='root',XAMPP=''
//   $pdo = new PDO('mysql:dbname=nm_db;charset=utf8;host=localhost','root','');
// } catch (PDOException $e) {
//   exit('DBConnection Error:'.$e->getMessage());
// }

$stmt = $pdo->prepare("SELECT*FROM nm_res_table");
$status = $stmt->execute();

$view="";
if($status==false) {
    //execute（SQL実行時にエラーがある場合）
  $error = $stmt->errorInfo();
  exit("SRL_ERROR:".$error[2]);

}else{
  //Selectデータの数だけ自動でループしてくれる
  //FETCH_ASSOC=http://php.net/manual/ja/pdostatement.fetch.php
  while( $r = $stmt->fetch(PDO::FETCH_ASSOC)){
    $view .= "<p>";
    $view .=h($r["name"]);
    $view .="</p>";
    $view .= "<p>";
    $view .=h($r["place"])."|".h($r["price"])."|".h($r["perpose"])."|".h($r["link"]);
    $view .="</p>";
    $view .= "<p>";
    $view .=h($r["point"]);
    $view .="</p>";
    $view .= '<a href="detail.php?id='.h($r["id"]).'">';
    $view .="[編集]";
    $view .= '</a>';
    $view .= '<a href="delete.php?id='.h($r["id"]).'">';
    $view .= "[削除]<br>";
    $view .= '</a>';
  }

}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>人におすすめしたいお店一覧</title>
<link rel="stylesheet" href="./CSS/data.css">
<style>div{padding: 10px;font-size:16px;}</style>
</head>
<body id="main">
<!-- Head[Start] -->
<header>
  <nav class="navbar-default">
      <a class="navbar-brand" href="index.php">人にお薦めしたいお店一覧</a>
  </nav>
</header>
<!-- Head[End] -->

<!-- Main[Start] -->
<div>
    <div class="container"><?=$view?></div>
</div>
<!-- Main[End] -->

</body>
</html>
