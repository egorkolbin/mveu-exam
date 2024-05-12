<?php
include("./db.php");
echo "<link rel='stylesheet' type='text/css' href='/css/components/header.css'>";
?>
<header class="header">
    <div class="header-container container">
        <div class="header-logo">
            logo
        </div>
        <div class="header-menu">
            <a href="/index.php">Главная</a>

          <?php
          if ($_SESSION['user']) {
            ?>
              <a href="/auth.php">Оставить заявку</a>
            <?php
          } ?>

          <?php
          if ($_SESSION['user'] && $_SESSION['user']['role'] == 1) {
            ?>
              <a href="/auth.php">Админ Панель</a>
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
    </div>
</header>