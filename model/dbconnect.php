<?php

$dbHost = 'host.docker.internal';
$dbName = 'logindb';
$dbUser = 'postgres';
$dbPassword = '1234';

try {
  $pdo = new PDO("pgsql:host=$dbHost;port=5432;dbname=$dbName", $dbUser, $dbPassword, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);

  echo "Conexão realizada com sucesso!";
} catch (PDOException $e) {
  echo "Falha ao conectar com o banco de dados";
  die($e->getMessage());
}

//pg_connect("host=$dbHost port=5432 dbname=$dbName user=$dbUser password=$dbPassword");