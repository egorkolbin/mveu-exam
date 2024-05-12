<?php
include("db.php");
$user_id = $_SESSION['user']['id'];

if ($_SESSION['user']['role'] != 1) {
  header("location: index.php");
}

if (isset($_GET['abort_app'])) {
  $str_del_app = "UPDATE `applications` SET `status` = 'Отклонена' WHERE `id` = '$_GET[abort_app]'";
  $run_del_app = mysqli_query($connect, $str_del_app);
  header("location: admin.php");
}
if (isset($_GET['cat_del'])) {
  $str_del_cat = "DELETE FROM `categories` WHERE `id` = '$_GET[cat_del]'";
  $run_del_cat = mysqli_query($connect, $str_del_cat);
  header("location: admin.php?cat");
}
if ($_POST['cat_add']) {
  $str_add_cat = "INSERT INTO `categories`(`id`, `title`) VALUES (NULL,'$_POST[cat_name]')";
  $run_add_cat = mysqli_query($connect, $str_add_cat);
  header("location: admin.php?cat");
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
    <link rel="stylesheet" href="css/profile.css">
    <script src="js/script.js"></script>
    <title>Админ панель</title>
</head>
<body>
<main class="main">
  <?php include("components/header.php") ?>
    <div class="main-container container">
        <div class="main-content">
            <div class="title">Админ панель</div>
            <div class="menu">
                <a href="admin.php">Заявки</a>
                <a href="admin.php?cat">Категории</a>
            </div>
          <?php
          if (!isset($_GET['cat'])) { ?>
              <div class="main-list">
                <?php
                $str_out_applications = "SELECT * FROM `applications` ORDER BY `applications`.`id` DESC";
                $run_out_applications = mysqli_query($connect, $str_out_applications);
                while ($out_applications = mysqli_fetch_array($run_out_applications)) {
                  switch ($out_applications['status']) {
                    case 'Новая':
                      $status = "<div class='application-status new'>Новая</div>";
                      break;
                    case 'Решена':
                      $status = "<div class='application-status done'>Решена</div>";
                      break;
                    case 'Отклонена':
                      $status = "<div class='application-status abort'>Отклонена</div>";
                      break;
                  };
                  ?>
                    <article class="application">
                        <img src="/img/upload/<?php echo $out_applications['image'] ?>" alt="">
                        <div class="application-title">
                            <span><?php echo $out_applications['title'] ?></span> <?php echo $status ?></div>
                        <div class="application-description"><?php echo $out_applications['description'] ?></div>
                        <div class="application-category">Категория - <?php echo $out_applications['category'] ?></div>
                        <div class="application-date"><?php echo $out_applications['date'] ?></div>
                      <?php if ($out_applications['status'] == 'Новая') { ?>
                          <div class="application-actions">
                              <a href="done-application.php?app=<?php echo $out_applications['id'] ?>">Решить</a>
                              <a href="admin.php?abort_app=<?php echo $out_applications['id'] ?>">Отклонить</a>
                          </div>
                      <?php } ?>
                    </article>
                <?php } ?>
              </div>
          <?php } else { ?>
              <form action="" class="form" method="POST">
                  <div class="form-block">
                      <div class="form-label">Название категории</div>
                      <input type="text" name="cat_name" class="form-input" required>
                  </div>
                  <div class="form-block">
                      <input type="submit" name="cat_add" value="Добавить категорию" class="form-btn" style="margin-top: 0">
                  </div>
              </form>
              <div class="cat-list">
                  <?php
                $str_out_cat = "SELECT * FROM `categories`";
                $run_out_cat = mysqli_query($connect, $str_out_cat);
                while ($out_cat = mysqli_fetch_array($run_out_cat)) { ?>
                    <div class="cat">
                        <span><?php echo $out_cat['title'] ?></span>
                        <a href="/admin.php?cat&cat_del=<?php echo $out_cat['id'] ?>" class="btn-delete">Удалить</a>
                    </div>
                <?php } ?>
              </div>
          <?php } ?>
        </div>
    </div>
  <?php include("components/footer.php") ?>
</main>
</body>
</html>