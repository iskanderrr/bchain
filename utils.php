<?php
require_once "pdo.php";
function getFullNameByPosterId($posterId) {
   global $pdo;
    $stmt = $pdo->prepare('SELECT fullName FROM users WHERE userId = ?');
    $stmt->execute([$posterId]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result ? $result['fullName'] : null;
}
function getFullNameById($user = null) {
    if ($user === null) {
        $user = $_SESSION['user'] ?? null;
    }
    global $pdo;
     $stmt = $pdo->prepare('SELECT fullName FROM users WHERE userId = ?');
     $stmt->execute([$user]);
     $result = $stmt->fetch(PDO::FETCH_ASSOC);
     return $result ? $result['fullName'] : null;
 }
 function getEmailById() {
    global $pdo;
     $stmt = $pdo->prepare('SELECT email FROM users WHERE userId = ?');
     $stmt->execute([$_SESSION['user']]);
     $result = $stmt->fetch(PDO::FETCH_ASSOC);
     return $result ? $result['email'] : null;
 }
 function getPicture(){
    global $pdo;

    $id= $_SESSION['user'];
    $sql="SELECT * from users WHERE userId=$id";
    $res=$pdo->query($sql);
    $user = $res->fetch(PDO::FETCH_ASSOC);
    return $user['pp']?$user['pp']:  null;

 }
 function getPosterPicture($posterId) {
    global $pdo;
     $stmt = $pdo->prepare('SELECT pp FROM users WHERE userId = ?');
     $stmt->execute([$posterId]);
     $result = $stmt->fetch(PDO::FETCH_ASSOC);
     return $result ? $result['pp'] : null;
 }
 function getLikeCount($postId) {
    global $pdo;
    $stmt = $pdo->prepare('SELECT likersId FROM Posts WHERE postId = ?');
    $stmt->execute([$postId]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $existingLikers = $result ? $result['likersId'] : null;
    $likersArray = $existingLikers ? explode(',', $existingLikers) : [];
    return count($likersArray);
}
function getLikersNames($postId) {
    global $pdo;
    $stmt = $pdo->prepare('SELECT likersId FROM Posts WHERE postId = ?');
    $stmt->execute([$postId]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $existingLikers = $result ? $result['likersId'] : null;
    $likersArray = $existingLikers ? explode(',', $existingLikers) : [];
    $likersCount = count($likersArray);



    if ($likersCount == 1) {
        $likerName = getFullNameByPosterId($likersArray[0]);
        return $likerName ? $likerName : 'xxx';
    } elseif ($likersCount > 1) {
        $names = [];
        for ($i = 0; $i < min(5, $likersCount); $i++) {
            $names[] = getFullNameByPosterId($likersArray[$i]);
        }
        if ($likersCount > 2) {
            $names[] = 'and ' . ($likersCount - 2) . ' others';
        }
        return implode(', ', $names);
    } else {
        return 'xxx';
    }
}
function generateVerification($userId){
    global $pdo;
    $verificationToken=uniqid();
    $req = "INSERT INTO email_verification (userId, verificationToken) VALUES (:userId, :verificationToken)";
    $stmt = $pdo->prepare($req);
    $stmt->bindParam(':userId', $userId);
    $stmt->bindParam(':verificationToken', $verificationToken);
    $stmt->execute();
    return $verificationToken;
    



}