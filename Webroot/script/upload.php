<?php
header('Content-type: application/json; charset=utf-8');
define("PDO", true);
include("pdo.php"); 
session_start();
$allowedExts = array("gif", "jpeg", "jpg", "png");
$temp = explode(".", $_FILES["image"]["name"]);
$extension = $temp[1];
$name = $temp[0];
$obj =  array();
$fileName = $_SESSION["user"].'_'.$name.'.'.$extension ;
chmod("temp/", 777);
if ((($_FILES["image"]["type"] == "image/gif")
|| ($_FILES["image"]["type"] == "image/jpeg")
|| ($_FILES["image"]["type"] == "image/jpg")
|| ($_FILES["image"]["type"] == "image/pjpeg")
|| ($_FILES["image"]["type"] == "image/x-png")
|| ($_FILES["image"]["type"] == "image/png"))
&& ($_FILES["image"]["size"] < 200000))
{
	if ($_FILES["image"]["error"] > 0)
	{
		echo "Return Code: " . $_FILES["image"]["error"] . "<br>";
	} 
	else 
	{
		if (file_exists("temp/" .$fileName ))
		{
			$obj["upload"] = 2;
		} 
		else 
		{
			move_uploaded_file($_FILES["image"]["tmp_name"],
			"temp/" .$fileName );
			$sql ="INSERT INTO `img_user`( `id_user`, `url`) VALUES ('".$_SESSION["user"]."','../custom_2/Webroot/script/temp/".utf8_encode ( $fileName)."');";
			$theRpd = $connexion->exec($sql);
			$obj["upload"] = 1;
		}
	}
} 
else 
{
  $obj["upload"] = 0;
}
echo json_encode($obj);
?>