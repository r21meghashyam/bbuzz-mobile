<?php
function decode($t)
	{
	return base64_decode($t);
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
?>