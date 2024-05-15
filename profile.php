<?php
require_once "pdo.php";
require_once 'protected.php';
require_once 'utils.php';
require_once 'sidebar.php';
$id= $_SESSION['user'];
$sql="SELECT * from users WHERE userId=$id";
$res=$pdo->query($sql);
$user = $res->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Profile</title>
  <link rel="stylesheet" href="css/style2.css">
    <link rel="stylesheet" href="css/side-bar.css">
    <link rel="stylesheet" href="css/post.css">
    <link rel="stylesheet" href="css/profile.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap" rel="stylesheet">
    
 
</head>
<body>
    <?php sidebar(11) ?>

    


  <div class="container mt-5">
    <div class="row">
      <div class="col-md-3">
        <!-- Profile Image -->
         <div class="card">
          <center><img src="<?= $user['pp']?>" class="card-img-top" alt="Profile Picture">
          <form action="modifprofile.php" method="POST" enctype="multipart/form-data">
            <input type="file" name="pp">
            <input type="submit" value="Change Picture">
          </form>  
          </center>
         </div>
      </div>
      <center>
      <div class="col-md-9">
        <form action="modifprofile.php" method="POST">
        <div class="card">
          <div class="card-header" style="text-align: center;">
            Profile Details
          </div>
          <div class="card-body">

          <input type="hidden" name="id" class="form-control" id="id" value="<?= $user['userId']?>">
            <div class="form-group">
              <label for="fullName">Full Name</label>
              <input type="text" name="fullName" class="form-control" id="fullName" value="<?= $user['fullName']?>">
            </div>
            <div class="form-group">
              <label for="email">Email</label>
              <input type="email" name="email" class="form-control" id="email" value="<?= $user['email']?>" readonly>
            </div>
            <div class="form-group">
              <label for="phone">Phone</label>
              <input type="tel" name="tel" class="form-control" id="phone" value="<?= $user['phoneNumber']?>">
            </div>
        </div>
        <input type="submit" value="change">
        </form>
      </div>
    </div>
  </div>
  </center>

  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>


