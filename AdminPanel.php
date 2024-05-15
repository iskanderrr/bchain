<?php
require_once "pdo.php";
require_once 'protected.php';
require_once 'utils.php';
require_once 'sidebar.php';
function isAdmin() {
   
    return isset($_SESSION['role']) && $_SESSION['role'] === 'ADMIN';
}


if (!isAdmin()) {

    header("Location: index.php"); 
    exit;
}










$sql="SELECT * from Posts";
$res=$pdo->query($sql);

?>





<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/AdminPanel.css">
    <link rel="stylesheet" href="css/side-bar.css">
    <link rel="stylesheet" href="css/style2.css">
   
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap" rel="stylesheet">
    <title>Document</title>
</head>
<body style="margin-left: 260px;background-color: #F9F9F9;">

<?php sidebar(3) ?>
      
<center>
<table style="background-color: white;margin-top:50px;">
        <tr>
            <th>PostId</th>
            <th>PostTitle</th>
            <th>PostMedia</th>

            <th>PosterId</th>
            <th>likersId</th>
            <th>likeCount</th>
            <th>PostTime</th>
            <th>IsBanned</th>
            <th>Action</th>
        </tr>
        <?php 
            foreach($res as $post)
            {

            ?>
        <tr>
 

            <td><?= $post['postId']?></td>
            <td><?= $post['postTitle']?></td>

            
            <td>
                <?php 
                    if($post['postFile'] != null)
                    {
                    ?>
                <img src ="<?= $post['postFile']?>" alt="postImg" width="50px" height="50px"/>
                <?php }
                    else {
                        echo "-";
                    }
                        
                 ?>
            </td>
            <td><?= $post['posterId']?></td>
            <td><?= $post['likersId']?></td>
            <td><?= getLikeCount($post['postId'])?></td>
            <td><?= $post['postTime']?></td>

            <td> 
                <?php 
                    if($post['isBanned'] == 'NOTBANNED')
                    {
                    ?>
                <button class="btn-conf">NotBanned
                </button> 
                <?php }
                    else { ?>
                <button class="btn-ban">Banned
                </button> 
                        
                <?php    }
                        
                 ?>
                 </td>
            <td>
                <a href="ban.php?post_id=<?= $post['postId']?>"><svg width="33" height="34" viewBox="0 0 33 34" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <rect y="0.5" width="33" height="33" rx="10" fill="#CA4E2E"/>
                    <path d="M22 17C22 20.0376 19.5376 22.5 16.5 22.5C13.4624 22.5 11 20.0376 11 17C11 13.9624 13.4624 11.5 16.5 11.5C18.0599 11.5 19.4667 12.1481 20.4689 13.1924C21.4182 14.1816 22 15.5218 22 17Z" stroke="white" stroke-width="2"/>
                </svg></a>

            </td>
        </tr>
        <?php 
            }

        ?>

        

        



    </table>



</center>


    
</body>
</html>