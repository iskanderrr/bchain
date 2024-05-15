<?php
require_once "pdo.php";
$token = $_GET['token'] ?? '';

if (!empty($token)) {
    // Prepare and execute a query to find the user with the given token
    $stmt = $pdo->prepare("SELECT * FROM email_verification WHERE verificationToken = :token");
    $stmt->bindParam(':token', $token);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        // Update the user's role to 'USER'
        $stmt = $pdo->prepare("UPDATE users SET role = 'USER' WHERE userId = :userId");
        $stmt->bindParam(':userId', $user['userId']);
        $stmt->execute();

        echo "User role updated successfully!";
    } else {
        echo "Invalid or expired token.";
    }
} else {
    echo "Token not provided.";
}
?>
