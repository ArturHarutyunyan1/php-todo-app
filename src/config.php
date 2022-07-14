<?php
include './auth/auth.php';
require 'db.php';

$author = $_SESSION['email'];

if(isset($_REQUEST['add'])){
    $todo = stripslashes($_REQUEST['todo']);
    $todo = mysqli_real_escape_string($con, $todo);

    $sql    = "INSERT INTO `todos` (`todo`, `status`, `author`) VALUES ('$todo', 0, '$author')";
    $result = mysqli_query($con, $sql);
    
    if($result){
        header("Location: ../index.php");
    }
}

if(isset($_REQUEST['check'])){
    $id = $_REQUEST['check'];
    
    $sql = "SELECT `status` FROM `todos` WHERE `id` = '$id'";
    $result = mysqli_query($con, $sql);

    foreach($result as $key => $res){
        if($res['status'] == 0){
            $sql = "UPDATE `todos` SET `status` = 1 WHERE `id` = '$id'";
            $result = mysqli_query($con, $sql);
        }else if($res['status'] == 1){
            $sql = "UPDATE `todos` SET `status` = 0 WHERE `id` = '$id'";
            $result = mysqli_query($con, $sql);
        }
    }
    header("Location: ../index.php");
}

if(isset($_REQUEST['remove'])){
    $id = $_REQUEST['remove'];

    $sql = "DELETE FROM `todos` WHERE `id` = '$id'";
    $result = mysqli_query($con, $sql);

    if($result){
        header("Location: ../index.php");
    }
}

?>