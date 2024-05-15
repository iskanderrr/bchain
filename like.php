<?php
require_once "pdo.php";
require_once 'protected.php';
foreach ($_POST as $key => $value) {
    echo "$key => $value <br>";
}
// Check if the request is a POST request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $postID = $_POST['postID'];
    $userID=$_SESSION["user"];
    if ($postID && $userID) {
        // Retrieve current likers' IDs for this post
        $stmt = $pdo->prepare('SELECT likersId FROM Posts WHERE postID = ?');
        $stmt->execute([$postID]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            $existingLikers = $result['likersId'];
            $likersArray = $existingLikers ? explode(',', $existingLikers) : [];

            // Only add user if not already in the likers list
            if (!in_array($userID, $likersArray)) {
                $likersArray[] = $userID;
                $updatedLikers = implode(',', $likersArray);

                // Update the post with the new list of likers
                $updateStmt = $pdo->prepare('UPDATE Posts SET likersId = ? WHERE postID = ?');
                $updateStmt->execute([$updatedLikers, $postID]);

                echo "Successfully liked post with ID $postID.";
            } else {
                $index = array_search($userID, $likersArray);
                if ($index !== false) {
                    unset($likersArray[$index]);
                    $updatedLikers = implode(',', $likersArray);
            
                    // Update the post with the new list of likers
                    $updateStmt = $pdo->prepare('UPDATE Posts SET likersId = ? WHERE postID = ?');
                    $updateStmt->execute([$updatedLikers, $postID]);
            
                    echo "Successfully unliked post with ID $postID.";
                }
            }
        } else {
            echo "Post not found.";
        }
    } else {
        echo "Invalid post ID or user not logged in.";
    }
}
?>
