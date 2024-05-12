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
    <title><?php echo $_SESSION['user']['fullname'];?></title>
</head>
<body>
<main class="main">
  <?php include("components/header.php") ?>
    <div class="main-container container">
        <div class="main-content">
            <div class="title"><?php echo $_SESSION['user']['fullname'];?></div>
        </div>
    </div>
  <?php include("components/footer.php") ?>
</main>
</body>
</html>