<?php

$dbHost = 'host.docker.internal';
$dbName = 'newzzer';
$dbUser = 'postgres';
$dbPassword = '';

try {
  $pdo = new PDO("pgsql:host=$dbHost;port=5432;dbname=$dbName", $dbUser, $dbPassword, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
} catch (PDOException $e) {
  throw new Exception("Falha ao conectar com o banco de dados");
}
