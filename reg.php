<?php
include("db.php");

if ($_SESSION['user']){
    $user_id = $_SESSION['user']['id'];
  header("location: profile.php?id=$user_id");
}

$fullname = $_POST['fullname'];
$login = $_POST['login'];
$email = $_POST['email'];
$password = $_POST['password'];
$password2 = $_POST['password2'];
$checkbox = $_POST['checkbox'];
$reg = $_POST['reg'];

$password_error = false;

$str_add_user = "INSERT INTO `users`(`id`, `fullname`, `login`, `email`, `password`, `role`) VALUES (NULL, '$fullname', '$login', '$email', '$password', 0)";

if ($reg) {
  if ($password == $password2) {
    $str_auth_user = "SELECT * FROM `users` WHERE `login` = '$login' AND `password` = '$password' ";
    $run_auth_user = mysqli_query($connect, $str_auth_user);
    $count_user = mysqli_num_rows($run_auth_user);
    if ($count_user == 0) {
      $run_add_user = mysqli_query($connect, $str_add_user);
      if ($run_add_user) {
        $str_auth_user = "SELECT * FROM `users` WHERE `login` = '$login' AND `password` = '$password' ";
        $run_auth_user = mysqli_query($connect, $str_auth_user);
        $out_user = mysqli_fetch_array($run_auth_user);
        $_SESSION['user'] = ["fullname" => $out_user['fullname'], "id" => $out_user['id'], "role" => $out_user['role'], "email" => $out_user['email']];
        $user_id = $out_user['id'];
        header("location: profile.php?id=$user_id");
      }
    }
  } else {
    $password_error = true;
  }
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/reg.css">
    <script src="js/script.js"></script>
    <title>Регистрация</title>
</head>
<body>
<main class="main">
  <?php include("components/header.php") ?>
    <div class="main-container container">
        <div class="main-content">
            <div class="title">Регистрация</div>
            <form action="" class="form" method="POST">
                <div class="form-block">
                    <div class="form-label">ФИО</div>
                    <input type="text" name="fullname" class="form-input" required>
                </div>
                <div class="form-block">
                    <div class="form-label">Логин</div>
                    <input type="text" name="login" class="form-input" required>
                </div>
                <div class="form-block">
                    <div class="form-label">E-mail</div>
                    <input type="email" name="email" class="form-input" required>
                </div>
                <div class="form-block">
                    <div class="form-label">Пароль <?php if ($password_error) { ?>
                            <span>Пароли не совпадают</span> <?php } ?></div>
                    <input type="password" name="password" class="form-input" required>
                </div>
                <div class="form-block">
                    <div class="form-label">Повторите пароль <?php if ($password_error) { ?>
                            <span>Пароли не совпадают</span> <?php } ?></div>
                    <input type="password" name="password2" class="form-input" required>
                </div>
                <div class="form-block check">
                    <input type="checkbox" name="checkbox" class="form-input" required>
                    <div class="form-label">Согласие на обработку персональных данных</div>
                </div>
                <div class="form-block">
                    <input type="submit" name="reg" value="Зарегестрироваться" class="form-btn">
                </div>
            </form>
        </div>
    </div>
  <?php include("components/footer.php") ?>
</main>
</body>
</html>