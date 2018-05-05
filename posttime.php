<?php 

function posttime($t,$f=false)
	{
	$c=time();
	$gap=($f)?$t-$c:$c-$t;
	$ago=($f)?'':'ago.';
	switch(true)
		{
		case $gap<60:return "just now";break;
		case $gap<3600:return ($s=floor($gap/60))." min".($s>1?'s':'').$ago;break;
		case $gap<86400:return ($s=floor($gap/3600))." hr".($s>1?'s':'').$ago;break;
		case $gap<604800:return ($s=floor($gap/86400))." day".($s>1?'s':'').$ago;break;
		case $gap<31449600:return ($s=floor($gap/604800))." week".($s>1?'s':'').$ago;break;
		default:return "long ".(($f)?"time":"back");
		}
	}
?>