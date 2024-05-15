<?php
        require_once "pdo.php";
        require_once 'protected.php';
        $id= $_SESSION['user'];
    if(isset($_POST['fullName'])){
        $id = $_POST['id'];
        $newfullName = $_POST['fullName'];
        $newphoneNumber = $_POST['tel'];
    
        if($newfullName != null && $newphoneNumber != null )
        
        $sql = "UPDATE users SET fullName = :fullName, phoneNumber = :phoneNumber WHERE userId = :userId";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':fullName', $newfullName, PDO::PARAM_STR);
        $stmt->bindParam(':phoneNumber', $newphoneNumber, PDO::PARAM_STR);
        $stmt->bindParam(':userId', $id, PDO::PARAM_INT);
        $stmt->execute();
        header("Location:profile.php");
    }

    if(isset($_FILES['pp'])) {
        $fileName = $_FILES['pp']['name'];
        $fileTmp = $_FILES['pp']['tmp_name'];
        $fileName =$id.$fileName;
        $destination = 'img/'.$fileName;
        $img='img/'.$fileName;
        echo $img;
        if(move_uploaded_file($fileTmp, $destination)) {
            
            $sql = "UPDATE users SET pp ='$img' WHERE userId ='$id'";
            $pdo->exec($sql);
            header("Location:profile.php");
            
        } else {
            header("Location:profile.php");
        }
    }






?>