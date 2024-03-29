<?php
//1. GETデータ取得
$id = $_GET["id"];

//2. DB接続します
include("funcs.php");  //funcs.phpを読み込む（関数群）
$pdo = db_conn();      //DB接続関数

//３．データ削除SQL作成
$sql = "DELETE FROM nm_res_table WHERE id=:id";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id',$id, PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
$status = $stmt->execute(); //実行


//４．データ削除処理後
if($status==false){
    sql_error($stmt);
}else{
    redirect("data.php");
}

?>