<?php 
require_once('libraries/database.php');
class Comment
{ 
    public function findAllWithArticle() :array
    { 
        $pdo =getPdo();
         $resultats = $pdo->query('SELECT * FROM comments ORDER BY created_at DESC'); 
         $commentaires = $resultats->fetchAll(); 
         return $commentaires; 
    }
    public function find(int $id) :array
    {
        $pdo=getPdo();
        $query = $pdo->prepare('SELECT * FROM comments WHERE id = :id');
        $query->execute(['id' => $id]);
        $comment=$query->fetch(); return $comment; 
    }
    public function delete(int $id): void 
    {
        $pdo=getPdo(); 
        $query = $pdo->prepare('DELETE FROM comments WHERE id = :id');
        $query->execute(['id' => $id]); 
    }
    public function insert(string $author, string $content, int $article_id): void
    {
        $pdo = getPdo();  
        $query = $pdo->prepare('INSERT INTO comments SET author = :author, content = :content, article_id = :article_id, created_at = NOW()');
        $query->execute(compact('author', 'content', 'article_id'));
    }
}

