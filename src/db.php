<?php
$con = mysqli_connect('localhost', 'root', '',  'todo_app');

if(mysqli_connect_errno()){
    echo "Connection error " . mysqli_connect_errno();
}

?>