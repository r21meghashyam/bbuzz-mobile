<?php
$return="enter-code";
require('response.php');

if(empty($_SESSION['enter-code']['number']))
	respond(['error'=>8]);

if(empty($_POST['code']))
	respond(['error'=>10]);
	
require('sql.php');

if(!$connection=mysqli_connect($SQL_DOMAIN,$SQL_USERNAME,$SQL_PASSWORD,$DB))
	respond(['error'=>5,'line'=>__LINE__]);

if(!($result=mysqli_query($connection,'SELECT number,blocked,freeze_till,code_validity,code,attempts,suspense FROM numbers WHERE number="'.$_SESSION['enter-code']['number'].'"')))
	respond(['error'=>5,'line'=>__LINE__]);
list($number,$blocked,$freeze_till,$code_validity,$code,$attempts,$suspense)=mysqli_fetch_row($result);

if(!$number)
	respond(['changePage'=>'/']);
	
if(!$number||$blocked==1||$freeze_till>0)
	respond(['changePage'=>'/']);

if($code_validity<time())
	{
	respond(['changePage'=>'signup','error'=>22]);//VALIDITY EXPIRED
	}

if($code==$_POST['code'])
	{
	if(!($result=mysqli_query($connection,"update numbers set 
											code_validity=0,
											attempts=0,
											suspense=0,
											freeze_till=0 
											where NUMBER=".$_SESSION['enter-code']['number'])))
		respond(['error'=>5,'line'=>__LINE__]);
	$_SESSION['final-step']['number']=$_SESSION['enter-code']['number'];
	unset($_SESSION['enter-code']);
	$_SESSION['final-step']['code']=$_POST['code'];
	respond(['changePage'=>'final-step']);
	}
else
	{
	$attempts++;
	if($attempts>4)
		{
		$freeze_till=time()+(60*60);
		$suspense++;
		}
	if($suspense>4)
		$blocked=1;
	if(!($result=mysqli_query($connection,"update numbers set 
											attempts=".$attempts.",
											suspense=".$suspense.",
											freeze_till=".$freeze_till.",
											blocked=".$blocked."
											where NUMBER=".$_SESSION['enter-code']['number'])))
		respond(['error'=>5,'line'=>__LINE__]);
	if($blocked)
		respond(['changePage'=>'signup','error'=>6]);
	if($freeze_till>time())
		respond(['changePage'=>'signup','error'=>7,'time'=>$freeze_till]);
	respond(['error'=>11,'left'=>(5-$attempts)]);
	}
?>