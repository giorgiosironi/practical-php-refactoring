<?php
class Posts
{
    public function __construct(PDO $connection)
    {
        $this->connection = $connection;
    }

    /**
     * @param int $threadId
     * @param string $lastVisit Y-m-d format
     * @return array    fields for the selected post
     */
    public function lastPost($threadId, $lastVisit)
    {
        $stmt = $this->connection->prepare("SELECT * FROM posts WHERE id_thread = :id_thread AND date >= :date ORDER BY date");
        $stmt->bindValue(':id_thread', (int) $_GET['id_thread']);
        $stmt->bindValue(':date', $lastVisit);
        $stmt->execute();
        return $stmt->fetch();
    }
}
$dsn = 'mysql:host=localhost;dbname=practical_php_refactoring';
$username = 'root';
$password = '';
$posts = new Posts(new PDO($dsn, $username, $password));
if (!isset($_GET['last_visit'])) {
    $_GET['last_visit'] = date('Y-m-d');
}
$post = $posts->lastPost($_GET['id_thread'], $_GET['last_visit']);
?>
<div class="post">
    <div class="author"><?php echo $post['author']; ?></div>
    <div class="date"><?php echo $post['date']; ?></div>
    <div class="text"><?php echo $post['text']; ?></div>
</div>
