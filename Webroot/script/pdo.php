<?php

if(defined("PDO")){
$PARAM_hote='127.0.0.1'; // le chemin vers le serveur
$PARAM_port='3306';
$PARAM_nom_bd='swaii_coques'; // le nom de votre base de données
$PARAM_utilisateur='root'; // nom d'utilisateur pour se connecter
$PARAM_mot_passe=''; // mot de passe de l'utilisateur pour se connecter
try
{
        $connexion = new PDO('mysql:host='.$PARAM_hote.';dbname='.$PARAM_nom_bd, $PARAM_utilisateur, $PARAM_mot_passe);
}
 
catch(Exception $e)
{
        echo 'Erreur : '.$e->getMessage().'<br />';
        echo 'N° : '.$e->getCode();
        die();
}
}
else
{
echo "Something goes wrong " ; 
}
?>