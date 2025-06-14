<?php include 'session.php'; require 'config.php';
$id = $_GET['id'];
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $stmt = $conn->prepare("UPDATE posts SET title=?, content=? WHERE id=?");
    $stmt->bind_param("ssi", $title, $content, $id);
    $stmt->execute();
    header("Location: dashboard.php");
} else {
    $stmt = $conn->prepare("SELECT title, content FROM posts WHERE id=?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->bind_result($title, $content);
    $stmt->fetch();
}
?>
<form method="post">
    Title: <input type="text" name="title" value="<?= htmlspecialchars($title) ?>" required><br>
    Content:<br><textarea name="content" required><?= htmlspecialchars($content) ?></textarea><br>
    <button type="submit">Update</button>
</form>