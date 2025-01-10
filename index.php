<?php

/**
 * CE FICHIER A POUR BUT D'AFFICHER LA PAGE D'ACCUEIL !
 * 
 * On va donc se connecter à la base de données, récupérer les articles du plus récent au plus ancien (SELECT * FROM articles ORDER BY created_at DESC)
 * puis on va boucler dessus pour afficher chacun d'entre eux
 */

/**
 * 1. Connexion à la base de données avec PDO
 * Attention, on précise ici deux options :
 * - Le mode d'erreur : le mode exception permet à PDO de nous prévenir violament quand on fait une erreur ;-)
 * - Le mode d'exploitation : FETCH_ASSOC veut dire qu'on exploitera les données sous la forme de tableaux associatifs
 */
// require_once ('libraries/database.php');
require_once('libraries/models/Model.php');
require_once('libraries/utils.php');
require_once('libraries/models/Article.php');
$model=new Article();
$pdo =getPdo();

/**
 * 2. Récupération des articles
 */
// On utilisera ici la méthode query (pas besoin de préparation car aucune variable n'entre en jeu)
// $resultats = $pdo->query('SELECT * FROM articles ORDER BY created_at DESC');
// On fouille le résultat pour en extraire les données réelles
$articles = $model->findAll("created_at DESC");

/**
 * 3. Affichage
 */
$pageTitle = "Accueil";
$variables = [
    'articles' => $articles,
    'Accueil' => $pageTitle
];

render('articles/index', $variables);
require('templates/articles/index.html.php');
$pageContent = ob_get_clean();

require('templates/layout.html.php');
