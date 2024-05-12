<?php
include("./db.php");
echo "<link rel='stylesheet' type='text/css' href='/css/components/header.css'>";
?>
<header class='header'>
    <div class='header-container container'>
        <div class='header-logo'>
            Logo
        </div>
        <div class='header-menu menu'>
            <div class='menu-burger burger'>
                <span></span>
                <span></span>
                <span></span>
            </div>
            <nav class='menu-body'>
                <div class='menu-list'>
                    <a href="/index.php">Главная</a>

                  <?php
                  if ($_SESSION['user']) {
                    ?>
                      <a href="/application.php">Оставить заявку</a>
                    <?php
                  } ?>

                  <?php
                  if ($_SESSION['user'] && $_SESSION['user']['role'] == 1) {
                    ?>
                      <a href="/admin.php">Админ Панель</a>
                    <?php
                  } ?>

                  <?php
                  if ($_SESSION['user']) {
                    ?>
                      <a href="/auth.php">Профиль</a>
                    <?php
                  } else { ?>
                      <a href="/auth.php">Авторизация</a>
                  <?php } ?>

                  <?php
                  if ($_SESSION['user']) {
                    ?>
                      <a href="/controllers/exit.php">Выход</a>
                    <?php
                  } else { ?>
                      <a href="/reg.php">Регистрация</a>
                  <?php } ?>
                </div>
            </nav>
        </div>
    </div>
</header>