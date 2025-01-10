<?php 
// require_once('libraries/database.php');
require_once('libraries/models/Model.php');
class Comment extends Model
{ 
    protected $table="comments";
    public function findAllWithArticle(int $id) :array
    { 
        
         $resultats = $this->pdo->query('SELECT * FROM comments WHERE article_id='.$id.' ORDER BY created_at DESC'); 
         $commentaires = $resultats->fetchAll(); 
         return $commentaires; 
    }
   
    public function insert(string $author, string $content, int $article_id): void
    {
          
        $query = $this->pdo->prepare('INSERT INTO comments SET author = :author, content = :content, article_id = :article_id, created_at = NOW()');
        $query->execute(compact('author', 'content', 'article_id'));
    }
}

