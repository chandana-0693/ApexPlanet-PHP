<?php include 'session.php'; require 'config.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $stmt = $conn->prepare("INSERT INTO posts (title, content) VALUES (?, ?)");
    $stmt->bind_param("ss", $title, $content);
    if ($stmt->execute()) {
        header("Location: dashboard.php");
    }
}
?>
<form method="post">
    Title: <input type="text" name="title" required><br>
    Content:<br><textarea name="content" required></textarea><br>
    <button type="submit">Post</button>
</form>