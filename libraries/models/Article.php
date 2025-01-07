<?php 
require_once('libraries/database.php');
class Article
{ 
    public function findAll() : array
{ 
    $pdo =getPdo();
     $resultats = $pdo->query('SELECT * FROM articles ORDER BY created_at DESC'); 
     $articles = $resultats->fetchAll(); 
     return $articles; 
}

public function find(int $id) 
 { 
    $pdo =getPdo(); 
    $query = $pdo->prepare("SELECT * FROM articles WHERE id = :article_id");
    $query->execute(['article_id' => $id]);
    $article = $query->fetch();
     return $article; 
}
public function delete(int $id) : void
{
    $pdo = getPdo();
    $query = $pdo->prepare('DELETE FROM articles WHERE id = :id');
    $query->execute(['id' => $id]);
}

}

