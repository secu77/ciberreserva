<?php

require_once "config/db.php";

session_start();
$err = '';

if (isset($_POST['email']) && isset($_POST['password'])) {
  if (mysqli_connect_errno()) {
    echo 'Database Connection error...' . PHP_EOL;
    exit();
  }

  $stmt = $mysqli->prepare("SELECT password FROM users WHERE email=?");
  $stmt->bind_param('s', $_POST['email']);

  if ($stmt->execute()) {
    $stmt->bind_result($password);
    $stmt->fetch();
    
    if(isset($password)){
      if (md5($_POST['password']) === $password) {
        $_SESSION['id'] = $_POST['email'];
        header('Location: admin.php');
        exit();
      } else {
        $err = '<div class="alert alert-danger"><strong>Error!</strong> Invalid password or user!</div>';
      }
    } else {
      $err = '<div class="alert alert-danger"><strong>Error!</strong> Invalid password or user!</div>';
    }
  } else {
    $err = '<div class="alert alert-danger">'.$mysqli->error.'</div>';
  }
  $mysqli->close();
}

?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="./favicon.ico">

    <title>CiberReserva Intel</title>

    <!-- Bootstrap core CSS -->
    <link href="./css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="./css/signin.css" rel="stylesheet">
  </head>

  <body class="text-center">
    <form class="form-signin" action="" method="POST">
      <img class="mb-4" src="./images/logo.jpeg" alt="CiberReserva Logo" width="200" height="200">
      <label for="inputEmail" class="sr-only">Email address</label>
      <input name="email" type="text" id="inputEmail" class="form-control" placeholder="Email address" required autofocus>
      <label for="inputPassword" class="sr-only">Password</label>
      <input name="password" type="password" id="inputPassword" class="form-control" placeholder="Password" required>
      <div class="checkbox mb-3">
        <label id="checkcontent">
          <input id="checkbox" type="checkbox" value="remember-me"> Remember me
        </label>
      </div>
      <?= $err ?>
      <button id="button-signin" class="btn btn-lg btn-primary btn-block" type="submit">Submit</button>
      <p class="mt-5 mb-3 text-muted">&copy; CiberReserva 2021</p>
    </form>
  </body>
</html>
