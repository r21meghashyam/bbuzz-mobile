<?php
function encode($t)
	{
	return toggle_case(base64_encode($t));
	}

function toggle_case($t)
	{
	for($i=0;$i<strlen($t);$i++)
		{
		if(ctype_upper($t[$i]))
			{
			$t[$i]=strtolower($t[$i]);
			continue;
			}
		if(ctype_lower($t[$i]))
			$t[$i]=strtoupper($t[$i]);
		}
	return $t;
	}
function login($num)
	{
	$key=md5(rand(0,pow(10,10)));
	setcookie('key',$key);
	$_SESSION['key']=$key;
	$_SESSION['number']=$num;
	}
?>