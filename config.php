<?php
session_start();
$pdo = new PDO("mysql:host=127.0.0.1;port=3306;dbname=koo_2_fourchette;charset=utf8mb4","site","site1234");
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>
