<?php

session_start();

$username = 'gabriel@volkker.com.br';
$password = '123456';

$usernameForm = $_POST['username'] ?? null;
$passwordForm = $_POST['password'] ?? null;

$statusCode = 200;

verifyValidLogin($username, $usernameForm, $password, $passwordForm);

function verifyValidLogin($username, $usernameForm, $password, $passwordForm)
{
  if ($username == $usernameForm && $password == $passwordForm) {
    $_SESSION['login'] = $username;
    $message = 'Login realizado com sucesso!';
    $statusCode = 200;
    TransformToJson($message, $statusCode);
  } else {
    verifyFieldsAreEmpty($usernameForm, $passwordForm);
  }
}

function verifyFieldsAreEmpty($usernameForm, $passwordForm)
{
  if (!$usernameForm || !$passwordForm) {
    $message = 'Os campos não podem estar vazios';
    $statusCode = 400;
    transformToJson($message, $statusCode);
  } else {
    verifyValidEmail($usernameForm);
  }
}

function verifyValidEmail($usernameForm)
{
  if (!strpos($usernameForm, '@')) {
    $message = 'Informe um e-mail válido';
    $statusCode = 400;
    TransformToJson($message, $statusCode);
  } else {
    invalidLogin();
  }
}

function invalidLogin()
{
  $message = 'Acesso negado! Informações inválidas';
  $statusCode = 401;
  TransformToJson($message, $statusCode);
}


function transformToJson($message, $statusCode)
{
  header('Content-type: application/json');
  http_response_code($statusCode);

  echo json_encode(
    [
      'status' => $statusCode,
      'message' => $message
    ]
  );
}
