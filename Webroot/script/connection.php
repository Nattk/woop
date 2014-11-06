<?php
//include configuration 
//include '../include/inc.config.php';
define("PDO", true);
include("pdo.php"); 
session_start();
header('Content-type: application/json; charset=utf-8');
$postdata = file_get_contents("php://input");
$request = json_decode($postdata);
$action = $request->doIt;
if(isset($action) && !is_null($action))
{
	switch ($action) {
		case 'check':
			ifIsConnect();
			break;
      case 'login':
         login($request ,$connexion ) ;
         break;
	  case 'fbLogin':
		fbLogin($request, $connexion);
		break;
	case 'checkFb':
		fbCheck($request, $connexion);
		break;
		default:
		echo "undefined action";
			break;
	}
} 
else
echo"pas de post";


function ifIsConnect()
{ 
	$array = array();
	//test existance of a coockie connection
	if(isset($_COOKIE['user']) && !is_null($_COOKIE['user']))
	{
	 $array['connect']=1;
	 $array['user']=$_SESSION['user'] = $_COOKIE['user'];
	}
	else
	{
	$array['connect']=0;	
	}
	
	echo json_encode($array);
	// end of the test
}
function fbCheck($prequest, $c)
{
$id = $prequest->fbId;
$_SESSION["id_facebook"]= $id;	
$query = "SELECT `id` ,`id_facebook` FROM `sw_user` WHERE `id_facebook` = '". $id."';"; 
$r = $c->query($query) ;
$reponse= $r->fetchAll(PDO::FETCH_OBJ);
connecxionOk($reponse); 
$c = false ;
}
function login($prequest, $c)
{
$login = $prequest->login;
$mp = password_encode('passswaii', $prequest->mp);
$query = "SELECT `id` FROM `sw_user` WHERE `email` = '". $login."' AND `pass` = '".$mp."';"; 
$r = $c->query($query) ;
$reponse= $r->fetchAll(PDO::FETCH_OBJ);
connecxionOk($reponse); 
$c = false ;
}

function fbLogin($prequest, $c)
{
$query = "SELECT `id` FROM `sw_user` WHERE `id_Facebook` = '". $prequest->user->id."';"; 
$r = $c->query($query) ;
$reponse= $r->fetchAll(PDO::FETCH_OBJ);
facebookExistanceChecker( $prequest , $c, $reponse);
	
}

// Gestion de l'encodage de donnÃ©es
function password_decode($filter, $str){
   $filter = md5($filter);
   $letter = -1;
   $newstr = '';
   $str = base64_decode($str);
   $strlen = strlen($str);

   for ( $i = 0; $i < $strlen; $i++ ){
      $letter++;
      if ( $letter > 31 ){
         $letter = 0;
      }
      $neword = ord($str{$i}) - ord($filter{$letter});
      if ( $neword < 1 ){
         $neword += 256;
      }
      $newstr .= chr($neword);
   }
   return $newstr;
} // function password_decode($filter, $str)


function password_encode($filter, $str){
   $filter = md5($filter);
   $letter = -1;
   $newpass = '';

   $strlen = strlen($str);
   
   for ( $i = 0; $i < $strlen; $i++ ){
      $letter++;
      if ( $letter > 31 ){
         $letter = 0;
      }
      $neword = ord($str{$i}) + ord($filter{$letter});
      if ( $neword > 255 ){
         $neword -= 256;
      }
      $newpass .= chr($neword);
   }
   return base64_encode($newpass);
}

function connecxionOk($rpd)
{
	$obj =  array();
	if(isset($rpd[0]->id) && !is_null($rpd[0]->id))
	{	
		
		$_SESSION["user"]= $rpd[0]->id;
		$obj["user"]= $rpd[0]->id;
		setcookie("user", $rpd[0]->id, time()+7889232);
		if(isset($rpd[0]->id_facebook) && !is_null($rpd[0]->id_facebook))
		{
			$_SESSION["id_facebook"]=$rpd[0]->id_facebook;
			$obj["user_facebook"]=$rpd[0]->id_facebook;
		}
		else 
		{
			$obj["user_facebook"]=false;	
		}
	}
	else
	{
		$obj["id"]=  false;
	}
	 echo json_encode($obj);
}
function facebookExistanceChecker( $request , $pc, $rpd)
{
$obj =  array();
	$user = $request->user;
	if(isset($rpd[0]->id) && !is_null($rpd[0]->id))
	{	
		
		$_SESSION["user"]= $rpd[0]->id;
		$obj["user"]= $rpd[0]->id;
		setcookie("user", $rpd[0]->id, time()+7889232);
		
	}
	else
	{
		try{
	$sql ="INSERT INTO `sw_user`( `id_facebook`, `pseudo`, `prenom`, `nom`,`facebook`,`email`) VALUES ('".$request->user->id."','".$user->username."','".$user->first_name."','".$user->last_name."','".$user->link."'".$user->email."');";
		$theRpd = $pc->exec($sql);
		}
		catch(Exception $e)
		{
			echo "pas d'isertion dans la base de donnÃ©e possible ";
			print_r(e); 
		}
		if ($theRpd) {
		$query = "SELECT `id` FROM `sw_user` WHERE `id_Facebook` = '". $user->id."';"; 
		$r = $pc->query($query) ;
		$reponse= $r->fetchAll(PDO::FETCH_OBJ);
		$_SESSION["user"]= $reponse[0]->id;
		$obj["user"]=$reponse[0]->id;
		setcookie("user", $reponse[0]->id, time()+7889232);
		}
	}
	 echo json_encode($obj);
	$pc = false ;
}
?>