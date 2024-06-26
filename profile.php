<?php
include("db.php");
$user_id = $_SESSION['user']['id'];
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
    <title><?php echo $_SESSION['user']['fullname']; ?></title>
</head>
<body>
<main class="main">
  <?php include("components/header.php") ?>
    <div class="main-container container">
        <div class="main-content">
            <div class="title"><?php echo $_SESSION['user']['fullname']; ?></div>
            <div class="subtitle">
                Мои заявки
                <select onchange="location = this.value;">
                    <option value="">
                        Выберите статус
                    </option>
                    <option value="/profile.php?id=<?php echo $user_id ?>">
                        Все
                    </option>
                    <option value="/profile.php?id=<?php echo $user_id ?>&status=Новая">
                        Новая
                    </option>
                    <option value="/profile.php?id=<?php echo $user_id ?>&status=Решена">
                        Решена
                    </option>
                    <option value="/profile.php?id=<?php echo $user_id ?>&status=Отклонена">
                        Отклонена
                    </option>
                </select>
            </div>
            <div class="main-list">
              <?php
              if ($_GET['status']) {
                $str_out_applications = "SELECT * FROM `applications` WHERE `user_id` = '$user_id' AND `status` = '$_GET[status]' ORDER BY `applications`.`id` DESC";
              } else {
                $str_out_applications = "SELECT * FROM `applications` WHERE `user_id` = '$user_id' ORDER BY `applications`.`id` DESC";
              }
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
                  </article>
              <?php } ?>
            </div>
        </div>
    </div>
  <?php include("components/footer.php") ?>
</main>
</body>
</html>