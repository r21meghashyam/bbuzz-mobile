<?php 
require('response.php');
$return="login";
if(empty($_POST['username']))
	respond(['error'=>12]);
$username=$_POST['username'];
require('sql.php');

if(!$connection=mysqli_connect($SQL_DOMAIN,$SQL_USERNAME,$SQL_PASSWORD,$DB))
	respond(['error'=>5,'line'=>__LINE__]);

if(!($result=mysqli_query($connection,'SELECT username,id,password from users where ucase(username)=ucase("'.$username.'")')))
	respond(['error'=>5,'line'=>__LINE__]);

list($username,$id,$password)=mysqli_fetch_row($result);

if(!$username)
	respond(['error'=>20]);

if(!($result=mysqli_query($connection,'SELECT blocked,freeze_till,suspense,attempts from numbers where id='.$id)))
	respond(['error'=>5,'line'=>__LINE__]);

list($blocked,$freeze_till,$suspense,$attempts)=mysqli_fetch_row($result);

if($blocked)
	respond(['error'=>6]);

if($freeze_till>time())
	respond(['error'=>7,'time'=>$freeze_till]);

if(empty($_POST['password']))
	respond(['error'=>13]);
$entered_password=$_POST['password'];


if($password==$entered_password)
	{
	if(!($result=mysqli_query($connection,"update numbers set 
											code_validity=0,
											attempts=0,
											suspense=0,
											freeze_till=0 
											where id=".$id)))
		respond(['error'=>5,'line'=>__LINE__]);
	$_SESSION['id']=$id;
	respond(["changePage"=>"/"]);
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
		{
		$blocked=1;
		}
	if(!($result=mysqli_query($connection,"update numbers set 
											attempts=".$attempts.",
											suspense=".$suspense.",
											freeze_till=".$freeze_till.",
											blocked=".$blocked."
											where id=".$id)))
		respond(['error'=>5,'line'=>__LINE__]);
	if($blocked)
		respond(['error'=>6]);
	if($freeze_till>time())
		respond(['error'=>7,'time'=>$freeze_till]);
	respond(['error'=>21,'left'=>(5-$attempts)]);
	}
?>