<?php
include("db.php");
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/index.css">
    <script src="js/script.js"></script>
    <title>Главная</title>
</head>
<body>
<main class="main">
  <?php include("components/header.php") ?>
    <div class="main-container container">
        <div class="main-content">
            <div class="main-list">
              <?php
              $str_out_applications = "SELECT * FROM `applications` WHERE `status` = 'Решена' ORDER BY `applications`.`id` DESC LIMIT 4";
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
                      <div class="application-img">
                          <img src="/img/upload/<?php echo $out_applications['image'] ?>" class="img" alt="">
                          <img src="/img/upload/<?php echo $out_applications['image_done'] ?>" class="img-done" alt="">
                      </div>
                      <div class="application-title">
                          <span><?php echo $out_applications['title'] ?></span> <?php echo $status ?></div>
                      <div class="application-description"><?php echo $out_applications['description'] ?></div>
                      <div class="application-category">Категория - <?php echo $out_applications['category'] ?></div>
                      <div class="application-date"><?php echo $out_applications['date'] ?></div>
                  </article>
              <?php } ?>
            </div>
        </div>
    </div>
  <?php include("components/footer.php") ?>
</main>
</body>
</html>