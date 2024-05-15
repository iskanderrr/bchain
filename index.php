<?php
require_once "pdo.php";


?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/style2.css">
  <link rel="stylesheet" href="css/side-bar.css">
  <link rel="stylesheet" href="css/post.css">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap" rel="stylesheet">
  <title>Document</title>
  <script>
    function likePost(id) {
      const url = '/like.php';

      const data = new URLSearchParams();
      data.append('postID', id);

      fetch(url, {
        method: 'POST',
        headers: {
          'Content-Type': 'application/x-www-form-urlencoded',
          'Cookie': document.cookie
        },
        body: data
      })
        .then(response => {
          if (response.ok) {
            var element = document.getElementById(id);


            if (element.getAttribute("fill") === "blue") {
              element.setAttribute("fill", "none");
            } else {
              element.setAttribute("fill", "blue");
            }
            console.log('Request sent successfully');
          } else {
            console.error('Failed to send request');
          }
        })
        .catch(error => {
          console.error('Error:', error);
        });
    }



  </script>
</head>

<body style="background-color: #F9F9F9;">
    <?php require_once 'protected.php'; require_once 'sidebar.php';require_once 'utils.php';
sidebar(1) ?>

  <div class="container">
    <?php
    $sql = "SELECT * from Posts WHERE isBanned='NOTBANNED' ";
    $res = $pdo->query($sql);

    foreach ($res as $post) {
      $stmt = $pdo->prepare('SELECT likersId FROM Posts WHERE postID = ?');
      $stmt->execute([$post['postId']]);

      $result = $stmt->fetch(PDO::FETCH_ASSOC);

      $existingLikers = $result['likersId'];
      $likersArray = $existingLikers ? explode(',', $existingLikers) : [];
      if (in_array($_SESSION["user"], $likersArray)) {
        $isLiked = "blue";
      } else {
        $isLiked = 'none';
      }


      ?>
      <div class="card" style="background-color: white;">
        <div class="card-header">
          <img src="<?= getPosterPicture($post['posterId'])?>" alt="">
          <p><b> <?= getFullNameByPosterId($post['posterId']) ?></b></p>
        </div>
        <p style="padding-left: 18px;padding-top: 5px;"><?= $post['postTitle'] ?></p>
        <div class="card-content">
          <?php
          if ($post['postFile'] != null) {
            ?>
            <img src="<?= $post['postFile'] ?>" alt="">
          <?php } else {
            echo "<p>" . $post['postText'] . "</p>";

          }

          
          ?>
         
        </div>
        <p style="padding:5px;font-size:12px;opacity:0.5;"><?php echo getLikersNames($post['postId']); ?></p>
        <hr>
        <div class="card-footer">

          <svg width="18" height="18" viewBox="0 0 18 18" fill="<?= $isLiked ?>" xmlns="http://www.w3.org/2000/svg"
            id=<?= $post['postId'] ?> onclick="likePost(<?= $post['postId'] ?>)">
            <path
              d="M5.61 13.7625L7.935 15.5625C8.235 15.8625 8.91 16.0125 9.36 16.0125H12.21C13.11 16.0125 14.085 15.3375 14.31 14.4375L16.11 8.96248C16.485 7.91248 15.81 7.01248 14.685 7.01248H11.685C11.235 7.01248 10.86 6.63748 10.935 6.11248L11.31 3.71248C11.46 3.03748 11.01 2.28748 10.335 2.06248C9.735 1.83748 8.985 2.13748 8.685 2.58748L5.61 7.16248"
              stroke="#9A9A9A" stroke-width="1.5" stroke-miterlimit="10" />
            <path
              d="M1.785 13.7625V6.41255C1.785 5.36255 2.235 4.98755 3.285 4.98755H4.035C5.085 4.98755 5.535 5.36255 5.535 6.41255V13.7625C5.535 14.8125 5.085 15.1875 4.035 15.1875H3.285C2.235 15.1875 1.785 14.8125 1.785 13.7625Z"
              stroke="#9A9A9A" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
          </svg>

        </div>




      </div>
      <?php
    }
    ?>
  </div>

  </script>
</body>
</html>
<?php
$currentUrl = $_SERVER['REQUEST_URI'];

?>
