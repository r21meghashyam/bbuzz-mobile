<?php 
require('response.php');
if(empty($_SESSION['id']))
	respond(['changePage'=>'/']);

require('sql.php');

if(!$connection=mysqli_connect($SQL_DOMAIN,$SQL_USERNAME,$SQL_PASSWORD,$DB))
	respond(['error'=>5,'line'=>__LINE__]);

if(!($result=mysqli_query($connection,'SELECT id from users where id='.$_SESSION['id'])))
	respond(['error'=>5,'line'=>__LINE__]);

if(!mysqli_fetch_row($result)[0])
	respond(['changePage'=>'logout.php']);
?>