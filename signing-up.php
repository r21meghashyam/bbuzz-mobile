<?php
require('response.php');

$return='signup';

if(empty($_POST['isd']))
	respond(Array('error'=>1));

if(empty($_POST['number']))
	respond(Array('error'=>2));

$isd=$_POST['isd'];
$num=$_POST['number'];

if($isd!=91)
	respond(Array('error'=>3));


if(strlen($num)==12)
	$num=substr($num,2,10);

if(strlen($num)!=10||!is_numeric($num))
	respond(Array('error'=>4));

$num=$isd.$num;

require('sql.php');
if(!$connection=mysqli_connect($SQL_DOMAIN,$SQL_USERNAME,$SQL_PASSWORD,$DB))
	respond(Array('error'=>5,'line'=>__LINE__));

if(!($result=mysqli_query($connection,'SELECT blocked,freeze_till,code_validity,id,suspense FROM numbers WHERE number='.$num)))
	respond(Array('error'=>5,'line'=>__LINE__));

$current_timestamp=time();
$code=rand(1111,9999);

if($result->num_rows>0)
	{
	list($blocked,$freeze_till,$code_validity,$id,$suspense)=mysqli_fetch_row($result);
	
	if($blocked==1)
		respond(Array('error'=>6));

	
	if($current_timestamp<$freeze_till)
		respond(Array('error'=>7,'time'=>$freeze_till));

	if($code_validity>0)
		{
		if(time()<$code_validity)
			{
			$_SESSION['enter-code']['number']=$num;
			respond(Array('changePage'=>'enter-code?r&s','hash'=>'code'));
			}
		$suspense++;
		}
	
	if($suspense>4)
		{
		$blocked=1;
		}
	
	if($id)
		{
		if(!($result=mysqli_query($connection,'SELECT username FROM users WHERE id='.$id)))
			respond(Array('error'=>5,'line'=>__LINE__));
		$a=mysqli_fetch_row($result);
		respond(Array('changePage'=>'login','username'=>$a[0],'hash'=>'password'));
		}
	
	if(!($result=mysqli_query($connection,"update numbers set 
											code=".$code.",
											code_validity=".($current_timestamp+(30*60)).",
											freeze_till=0,
											attempts=0,
											suspense=".$suspense.",
											blocked=".$blocked."
											where NUMBER=".$num)))
		respond(Array('error'=>mysqli_error($connection)));
	}
else
	{
	if(!($result=mysqli_query($connection,"INSERT INTO numbers(isd,number,code,code_validity) values(".$isd.",".$num.",".$code.",".($current_timestamp+(30*60)).")")))
		respond(Array('error'=>5,'line'=>__LINE__));		
	}
	
/*
$ch = curl_init();
curl_setopt($ch,CURLOPT_URL,  "http://api.mVaayoo.com/mvaayooapi/MessageCompose");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS,'user=r21meghashyam@yahoo.in:sendAmessage&senderID=TEST SMS&receipientno='.$num.'&msgtxt=Your B-buzz verification code is '.$code);
$buffer = curl_exec($ch);
if(empty($buffer)||substr($buffer,7,1)!=0)
	respond(Array('error'=>9));
curl_close($ch);
*/
$_SESSION['enter-code']['number']=$num;
respond(Array('changePage'=>'enter-code','hash'=>'code'));
?>