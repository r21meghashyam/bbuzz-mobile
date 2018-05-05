<?php

$return='final-step';
require('response.php');

if(empty($_SESSION['final-step']['number']))
	respond(['changePage'=>'/']);

require('sql.php');

if(!$connection=mysqli_connect($SQL_DOMAIN,$SQL_USERNAME,$SQL_PASSWORD,$DB))
	respond(['error'=>5,'line'=>12]);


if(!($result=mysqli_query($connection,'SELECT number,blocked,freeze_till,id FROM numbers WHERE number='.$_SESSION['final-step']['number'])))
	respond(['error'=>5,'line'=>16]);

list($number,$blocked,$freeze_till,$id)=mysqli_fetch_row($result);
if(!$number||$blocked||$freeze_till>0||$id)
	respond(['changePage'=>'/']);



if(empty($_POST['username']))
	respond(['error'=>12]);
$username=$_POST['username'];

if(preg_match('/[^[:alnum:]\_\.]+/i',$username))
	respond(['error'=>18]);

if(!($result=mysqli_query($connection,'SELECT username from users where ucase(username)=ucase("'.$username.'")')))
	respond(['error'=>5,'line'=>32]);

list($username2)=mysqli_fetch_row($result);

if($username2)
	respond(['error'=>19]);


if(empty($_POST['password']))
	respond(['error'=>13]);
$password=$_POST['password'];

if(strlen($password)<6)
	respond(['error'=>15]);
	
if(strlen($password)>24)
	respond(['error'=>16]);

if(empty($_POST['confirm_password']))
	respond(['error'=>14]);

	
if($password!=$_POST['confirm_password'])
	respond(['error'=>17]);


if(!($result=mysqli_query($connection,'Insert into users(username,password) values("'.$username.'","'.$password.'")')))
	respond(['error'=>5,'line'=>59]);

if(!($result=mysqli_query($connection,'select id from users where username="'.$username.'"')))
	respond(['error'=>5,'line'=>62]);

list($id)=mysqli_fetch_row($result);

if(!($result=mysqli_query($connection,'update numbers set id='.$id.' where number='.$number)))
	respond(['error'=>5,'line'=>67]);

$_SESSION['id']=$id;
respond(['changePage'=>'/']);
?>