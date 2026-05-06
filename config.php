<?php
session_start();
$pdo = new PDO("mysql:host=10.3.205.132;dbname=koo_2_fourchette;charset=utf8mb4","cece","poiuyt");
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);