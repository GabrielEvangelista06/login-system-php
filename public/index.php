<?php session_start() ?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="./assets/css/style.css">
  <title>Login</title>
</head>

<body>
  <?php


  if (!isset($_SESSION['login'])) {
    include('view/login.html');
  } else {
    if (isset($_GET['logout'])) {
      unset($_SESSION['login']);
      session_destroy();
      header('Location: index.php');
    } else {
      include('view/home.phtml');
    }
  }

  ?>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
  <script src="./assets/js/app.js"></script>
</body>

</html>