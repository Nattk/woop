<?php
header('Content-type: application/json; charset=utf-8');
define("PDO", true);
include("pdo.php"); 
$postdata = file_get_contents("php://input");
$request = json_decode($postdata);
$model = $request->md;
$query = "SELECT * FROM `coques` WHERE `modele` = '". $model."' AND `visible` = '1' ORDER BY `modele` ASC ;"; 
$r = $connexion->query($query) ;
$reponse= $r->fetchAll(PDO::FETCH_OBJ);
echo json_encode($reponse);
?>