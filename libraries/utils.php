<?php 
function render(string $path, array $variables =[])
 { //['var1' => 2, 'var2'=> "burri"] 
    // $var1 = 2; // $var2 = "burri" 
    extract($variables); 
    ob_start(); 
    require ('templates/' . $path . '.html.php');
     $pageContent = ob_get_clean(); 
     require('templates/layout.html.php'); 
 }