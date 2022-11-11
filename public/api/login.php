<?php

session_start();

$username = $_POST['username'] ?? null;
$password = $_POST['password'] ?? null;

$statusCode = 200;

include('../model/dbconnect.php');

verifyValidLogin($username, $password, $pdo);

function verifyValidLogin($username, $password, $conn) {

  $sql = "SELECT id, name, username FROM users WHERE username = :username AND password = md5(:password) LIMIT 1";

  $stmt = $conn->prepare($sql);
  $stmt->execute([
    'username' => $username,
    'password' => $password
  ]);
  $user = $stmt->fetch();

  if ($user) {
    $_SESSION['login'] = $username;
    $_SESSION['id'] = $user['id'];
    $_SESSION['name'] = $user['name'];
    $message = 'Login realizado com sucesso!';
    $statusCode = 200;
    TransformToJson($message, $statusCode);
  } else {
    verifyFieldsAreEmpty($username, $password);
  }
}

function verifyFieldsAreEmpty($username, $password) {
  if (!$username || !$password) {
    $message = 'Os campos não podem estar vazios';
    $statusCode = 400;
    transformToJson($message, $statusCode);
  } else {
    verifyValidEmail($username);
  }
}

function verifyValidEmail($username) {
  if (!strpos($username, '@')) {
    $message = 'Informe um e-mail válido';
    $statusCode = 400;
    TransformToJson($message, $statusCode);
  } else {
    invalidLogin();
  }
}

function invalidLogin() {
  $message = 'Acesso negado! Informações inválidas';
  $statusCode = 401;
  TransformToJson($message, $statusCode);
}


function transformToJson($message, $statusCode) {
  header('Content-type: application/json');
  http_response_code($statusCode);

  echo json_encode(
    [
      'status' => $statusCode,
      'message' => $message
    ]
  );
}
