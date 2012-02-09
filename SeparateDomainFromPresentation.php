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
class LastPostAction
{
    public function __construct(Posts $posts, $template)
    {
        $this->posts = $posts;
        $this->template = $template;
    }

    public function execute(array $getParameters)
    {
        if (!isset($getParameters['last_visit'])) {
            $getParameters['last_visit'] = date('Y-m-d');
        }
        $post = $this->posts->lastPost($getParameters['id_thread'],
                                       $getParameters['last_visit']);
        require $this->template;
    }
}
$dsn = 'mysql:host=localhost;dbname=practical_php_refactoring';
$username = 'root';
$password = '';
$action = new LastPostAction(
                new Posts(new PDO($dsn, $username, $password)),
                'last_post.php'
          );
$action->execute($_GET);
?>
