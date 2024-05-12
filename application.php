<?php
include("db.php");

$title = $_POST['title'];
$description = $_POST['description'];
$category = $_POST['category'];
$title = $_POST['title'];
$submit = $_POST['submit'];

$user_id = $_SESSION['user']['id'];

$image_name = $_FILES['image']['name'];
$image_type = $_FILES['image']['type'];
$image_tmp_name = $_FILES['image']['tmp_name'];
$image_size = $_FILES['image']['size'];
$image_path = "img/upload/$image_name";

$date = date("d.m.Y G:i");

$str_add_application = "INSERT INTO `applications`(`id`, `user_id`, `title`, `description`, `category`, `image`, `image_done`, `date`, `status`) VALUES (NULL, '$user_id', '$title','$description','$category','$image_name', '', '$date', 'Новая')";

if ($submit) {
  $run_add_application = mysqli_query($connect, $str_add_application);
  if ($run_add_application){
    move_uploaded_file($image_tmp_name, $image_path);
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
    <link rel="stylesheet" href="css/application.css">
    <script src="js/script.js"></script>
    <title>Оставить заявку</title>
</head>
<body>
<main class="main">
  <?php include("components/header.php") ?>
    <div class="main-container container">
        <div class="main-content">
            <div class="title">Оставить заявку</div>
            <form action="" class="form" method="POST" enctype="multipart/form-data">
                <div class="form-block">
                    <div class="form-label">Название</div>
                    <input type="text" name="title" class="form-input" required>
                </div>
                <div class="form-block">
                    <div class="form-label">Описание</div>
                    <textarea name="description" required class="form-textarea"></textarea>
                </div>
                <div class="form-block">
                    <div class="form-label">Категория</div>
                    <select name="category" class="form-select">
                      <?php
                      $str_out_cat = 'SELECT * FROM `categories`';
                      $run_out_cat = mysqli_query($connect, $str_out_cat);
                      while ($out_cat = mysqli_fetch_array($run_out_cat)) { ?>
                          <option value="<? echo $out_cat['title']; ?>"><? echo $out_cat['title']; ?></option>
                      <?php } ?>
                        <option value="прочее">прочее</option>
                    </select>
                </div>
                <div class="form-block">
                    <div class="form-label">Фотография</div>
                    <input type="file" name="image" class="form-file" accept="image/*" required>
                </div>
                <div class="form-block">
                    <input type="submit" name="submit" value="Отправить заявку" class="form-btn">
                </div>
            </form>
        </div>
    </div>
  <?php include("components/footer.php") ?>
</main>
</body>
</html>