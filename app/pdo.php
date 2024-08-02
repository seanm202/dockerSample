<?php
$pdo = new PDO('mysql:host=database;dbname=mydb;charset=utf8mb4', 'myuser', 'secret');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

?>
