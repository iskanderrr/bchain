<?php
require_once "pdo.php";

if(isset($_GET['post_id'])) {
    $id=$_GET['post_id'];
    $sql="SELECT * from Posts WHERE postId=$id";
    $res=$pdo->query($sql);
    $post = $res->fetch(PDO::FETCH_ASSOC);
    if($post['isBanned']=='NOTBANNED'){
        $post_id = $_GET['post_id'];
        $upd = "UPDATE Posts SET isBanned ='BANNED' WHERE postId =$post_id";
        $pdo->exec($upd);
        header("location:AdminPanel.php");
    }else{
        $post_id = $_GET['post_id'];
        $upd = "UPDATE Posts SET isBanned ='NOTBANNED' WHERE postId =$post_id";
        $pdo->exec($upd);
        header("location:AdminPanel.php");
    }

}