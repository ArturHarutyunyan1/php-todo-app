<?php
include './auth/auth.php';
require 'db.php';

$author = $_SESSION['email'];

if(isset($_REQUEST['add'])){
    $todo = stripslashes($_REQUEST['todo']);

    $stmt = $pdo -> query("INSERT INTO `todos` (`todo`, `status`, `author`) VALUES ('$todo', 0, '$author')");
    
    if($stmt){
        header("Location: ../index.php");
    }
}

if(isset($_REQUEST['check'])){
    $id = $_REQUEST['check'];
    
    $stmt = $pdo -> query("SELECT * FROM `todos` WHERE id = '$id'");

    foreach($stmt as $key => $res){
        if($res['status'] == 0){
            $stmt = $pdo -> query("UPDATE `todos` SET `status` = 1 WHERE id = '$id'");
        }else if($res['status'] == 1){
            $stmt = $pdo -> query("UPDATE `todos` SET `status` = 0 WHERE id = '$id'");
        }
    }
    header("Location: ../index.php");
}

if(isset($_REQUEST['remove'])){
    $id = $_REQUEST['remove'];

    $stmt = $pdo -> query("DELETE FROM `todos` WHERE id = '$id'");

    if($stmt){
        header("Location: ../index.php");
    }
}

?>