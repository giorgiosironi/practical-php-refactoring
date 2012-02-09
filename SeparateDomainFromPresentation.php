<?php
$dsn = 'mysql:host=localhost;dbname=practical_php_refactoring';
$username = 'root';
$password = '';
$dbh = new PDO($dsn, $username, $password);
$stmt = $dbh->prepare("SELECT * FROM posts WHERE id_thread = :id_thread AND date >= :date ORDER BY date");
$stmt->bindValue(':id_thread', (int) $_GET['id_thread']);
if (!isset($_GET['last_visit'])) {
    $_GET['last_visit'] = date('Y-m-d');
}
$stmt->bindValue(':date', $_GET['last_visit']);
$stmt->execute();
$post = $stmt->fetch();
?>
<div class="post">
    <div class="author"><?php echo $post['author']; ?></div>
    <div class="date"><?php echo $post['date']; ?></div>
    <div class="text"><?php echo $post['text']; ?></div>
</div>
