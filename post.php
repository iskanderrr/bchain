<?php
require_once "pdo.php";
require_once 'protected.php';
require_once 'sidebar.php';
require_once 'utils.php';
foreach ($_POST as $key => $value) {
    echo "$key => $value <br>";
}
// Check if form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'] ?? '';
    $text = $_POST['text'] ?? '';
    $attachment = null;

    // Process file attachment if it exists
    if (!empty($_FILES['attachment']['name'])) {
        $targetDirectory = 'uploads/';
        if (!is_dir($targetDirectory)) {
            mkdir($targetDirectory, 0777, true);
        }

        // Generate a unique name using timestamp and original extension
        $originalName = pathinfo($_FILES['attachment']['name'], PATHINFO_FILENAME);
        $extension = pathinfo($_FILES['attachment']['name'], PATHINFO_EXTENSION);
        $uniqueFileName = $originalName . '_' . uniqid() . '.' . $extension;
        $targetFile = $targetDirectory . $uniqueFileName;

        if (move_uploaded_file($_FILES['attachment']['tmp_name'], $targetFile)) {
            $attachment = $targetFile;
        }
    }

    // Prepare SQL insert statement
    $stmt = $pdo->prepare('INSERT INTO Posts (postTitle, postText, postFile,posterId, postTime) VALUES (?, ?, ?, ?,NOW())');
    $stmt->execute([$title, $text, $attachment, $_SESSION["user"]]);

    // Redirect to avoid resubmission
    header('Location: ' . $_SERVER['PHP_SELF']);
    exit();
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Post Content</title>

    <link rel="stylesheet" href="css/crPost.css">
    <link rel="stylesheet" href="css/side-bar.css">
    <link rel="stylesheet" href="css/style2.css">

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap" rel="stylesheet">
    <style>
        textarea:focus {
            outline: none !important;
        }
    </style>
</head>

<body style="background-color: #F9F9F9;">

    <?php sidebar(2) ?>
    <div class="create-card">
        <h1>Create a New Post</h1>
        <form action="post.php" method="POST" enctype="multipart/form-data">
            <fieldset style="width:210px;">
                <legend style="color:#9A9A9A; padding-left: 7px;padding-right: 7px;margin-left: 14px;">Body</legend>
                <div>
                    <textarea style="border:none;input:focus {outline:none;};width: 400px;padding-left: 18px;"
                        type='text' placeholder="What you have in mind?" id="text" rows="5" name="title" cols="30"
                        required></textarea>
                </div>
            </fieldset>




            <br><br>

            <label for="attachment">Post Image :</label>
            <input type="file" name="attachment" id="attachment">
            <br><br>
            <center><input id="btnn" type="submit" value="Create"></center>
        </form>

    </div>

</body>

</html>