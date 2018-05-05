<?php 
$SQL_DOMAIN='localhost';
$SQL_USERNAME='admin';
$SQL_PASSWORD='root';
$DB='master';

if(!$connection=mysqli_connect($SQL_DOMAIN,$SQL_USERNAME,$SQL_PASSWORD,$DB))
	{
	echo 'err';
	exit;
	}

if(!($result=mysqli_query($connection,'SELECT blocked,freeze,DATE_FORMAT(timestamp,"%H,%i,%s,%c,%d,%Y"),account_number,suspense FROM client_number WHERE number=918123928667')))
	{
	echo 'err';
	exit;
	}

$each=mysqli_fetch_row($result);
print_r($each);

$t=preg_split('/\,/i',$each[2]);
	$timestamp=mktime($t[0],$t[1],$t[2],$t[3],$t[4],$t[5]);
	$validity=mktime($t[0],$t[1],$t[2],$t[3],$t[4],$t[5])+(60*60);

echo $validity-time();
?>