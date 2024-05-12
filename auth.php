<?php
include("db.php");

if ($_SESSION['user']){
  $user_id = $_SESSION['user']['id'];
  header("location: profile.php?id=$user_id");
}

$login = $_POST['login'];
$password = $_POST['password'];
$reg = $_POST['reg'];

if ($reg) {
    $str_auth_user = "SELECT * FROM `users` WHERE `login` = '$login' AND `password` = '$password' ";
    $run_auth_user = mysqli_query($connect, $str_auth_user);
    $count_user = mysqli_num_rows($run_auth_user);
    if ($count_user == 1) {
        $out_user = mysqli_fetch_array($run_auth_user);
        $_SESSION['user'] = ["fullname" => $out_user['fullname'], "id" => $out_user['id'], "role" => $out_user['role'], "email" => $out_user['email']];
        $user_id = $out_user['id'];
        header("location: profile.php?id=$user_id");
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
    <link rel="stylesheet" href="css/auth.css">
    <title>Главная</title>
</head>
<body>
<main class="main">
  <?php include("components/header.php") ?>
    <div class="main-container container">
        <div class="main-content">
            <div class="title">Авторизация</div>
            <form action="" class="form" method="POST">
                <div class="form-block">
                    <div class="form-label">Логин</div>
                    <input type="text" name="login" class="form-input" required>
                </div>
                <div class="form-block">
                    <div class="form-label">Пароль</div>
                    <input type="password" name="password" class="form-input" required>
                </div>
                <div class="form-block">
                    <input type="submit" name="reg" value="Войти" class="form-btn">
                </div>
            </form>
        </div>
    </div>
  <?php include("components/footer.php") ?>
</main>
</body>
</html>