<?php
$host     = 'localhost';
$user     = 'root';
$password = '';
$dbname   = 'todo_app';

$dsn = "mysql:host=" . $host . ";dbname=" . $dbname;

$pdo = new PDO($dsn, $user, $password);

?>