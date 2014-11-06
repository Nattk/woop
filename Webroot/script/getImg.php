<?php
header('Content-type: application/json; charset=utf-8');
define("PDO", true);
include("pdo.php"); 
$postdata = file_get_contents("php://input");
$request = json_decode($postdata);
$user= $request->user;
$query = "SELECT * FROM `img_user` WHERE `id_user` = '".$user."' ORDER BY `date` DESC ;"; 
$r = $connexion->query($query) ;
$reponse= $r->fetchAll(PDO::FETCH_OBJ);
echo json_encode($reponse);
?>