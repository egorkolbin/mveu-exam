<?php
include("db.php");

$submit = $_POST['submit'];

$user_id = $_SESSION['user']['id'];

$image_name = $_FILES['image']['name'];
$image_type = $_FILES['image']['type'];
$image_tmp_name = $_FILES['image']['tmp_name'];
$image_size = $_FILES['image']['size'];
$image_path = "img/upload/$image_name";

if ($submit) {
  $str_done_app = "UPDATE `applications` SET `image_done` = '$image_name', `status` = 'Решена' WHERE `id` = '$_GET[app]'";
  $run_done_app = mysqli_query($connect, $str_done_app);
  if ($run_done_app) {
    move_uploaded_file($image_tmp_name, $image_path);
    header("location: admin.php");
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
    <link rel="stylesheet" href="css/application.css">
    <link rel="stylesheet" href="css/profile.css">
    <script src="js/script.js"></script>
    <title>Решить проблему</title>
</head>
<body>
<main class="main">
  <?php include("components/header.php") ?>
    <div class="main-container container">
        <div class="main-content">
            <div class="title">Решить проблему</div>
            <div class="main-list">
              <?php
              $str_out_applications = "SELECT * FROM `applications` WHERE `id` = '$_GET[app]'";
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
            <form action="" class="form" method="POST" enctype="multipart/form-data">
                <div class="form-block">
                    <div class="form-label">Для решения проблемы загрузите фотографию</div>
                    <input type="file" name="image" class="form-file" accept="image/*" required>
                </div>
                <div class="form-block">
                    <input type="submit" name="submit" value="Решить проблему" class="form-btn">
                </div>
            </form>
        </div>
    </div>
  <?php include("components/footer.php") ?>
</main>
</body>
</html>