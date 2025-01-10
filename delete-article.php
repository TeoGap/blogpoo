<?php

/**
 * DANS CE FICHIER, ON CHERCHE A SUPPRIMER L'ARTICLE DONT L'ID EST PASSE EN GET
 * 
 * Il va donc falloir bien s'assurer qu'un paramètre "id" est bien passé en GET, puis que cet article existe bel et bien
 * Ensuite, on va pouvoir effectivement supprimer l'article et rediriger vers la page d'accueil
 */

/**
 * 1. On vérifie que le GET possède bien un paramètre "id" (delete.php?id=202) et que c'est bien un nombre
 */
if (empty($_GET['id']) || !ctype_digit($_GET['id'])) {
    die("Ho ?! Tu n'as pas précisé l'id de l'article !");
}

$id = $_GET['id'];

/**
 * 2. Connexion à la base de données avec PDO
 * Attention, on précise ici deux options :
 * - Le mode d'erreur : le mode exception permet à PDO de nous prévenir violament quand on fait une erreur ;-)
 * - Le mode d'exploitation : FETCH_ASSOC veut dire qu'on exploitera les données sous la forme de tableaux associatifs
 * 
 * PS : Vous remarquez que ce sont les mêmes lignes que pour l'index.php ?!
 */
// require_once ('libraries/database.php');
require_once('libraries/models/Model.php');
require_once ('libraries/utils.php');
require_once('libraries/models/Article.php');
$model =new Article();

/**
 * 3. Utilisation de la fonction findArticle pour vérifier si l'article existe
 */
$article=$model->find($id);
if (!$article) {
    die("L'article $id n'existe pas, donc vous ne pouvez pas le supprimer !");
}

/**
 * 4. Réelle suppression de l'article
 */
$pdo = getPdo();
$model->delete($id);

/**
 * 5. Redirection vers la page d'accueil
 */
redirect('index.php');
exit();
