<?php

/**
 * DANS CE FICHIER ON CHERCHE A SUPPRIMER LE COMMENTAIRE DONT L'ID EST PASSE EN PARAMETRE GET !
 * 
 * On va donc vérifier que le paramètre "id" est bien présent en GET, qu'il correspond bien à un commentaire existant
 * Puis on le supprimera !
 */

/**
 * 1. Récupération du paramètre "id" en GET
 */
if (empty($_GET['id']) || !ctype_digit($_GET['id'])) {
    die("Ho ! Fallait préciser le paramètre id en GET !");
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
require_once ('libraries/database.php');
require_once ('libraries/utils.php');
require_once('libraries/models/Comment.php');
$model =new Comment();
$pdo =getPdo();

/**
 * 3. Vérification de l'existence du commentaire
 */
$comment=$model->find($id);
if (!$comment) {
    die("Le commentaire $id n'existe pas, donc vous ne pouvez pas le supprimer !");
}

/**
 * 4. Suppression réelle du commentaire
 * On récupère l'identifiant de l'article avant de supprimer le commentaire
 */


$article_id = $comment['article_id'];

$model->delete($id);

/**
 * 5. Redirection vers l'article en question
 */
// header("Location: article.php?id=" . $article_id);
redirect('article.php?id=' . $article_id);
exit();
