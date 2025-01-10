<?php 
require_once('libraries/database.php');
class Article extends Model
{ 
    
    public function findAll() : array
{ 
    
     $resultats = $this->pdo->query('SELECT * FROM articles ORDER BY created_at DESC'); 
     $articles = $resultats->fetchAll(); 
     return $articles; 
}

public function find(int $id) 
 { 
    
    $query = $this->pdo->prepare("SELECT * FROM articles WHERE id = :article_id");
    $query->execute(['article_id' => $id]);
    $article = $query->fetch();
     return $article; 
}
public function delete(int $id) : void
{
    
    $query = $this->pdo->prepare('DELETE FROM articles WHERE id = :id');
    $query->execute(['id' => $id]);
}

}

