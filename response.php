<?php
function respond($data,$page="/")
	{
	global $return;
	if(isset($_SERVER['HTTP_X_PAGE']))
			{
			if(isset($data['error']))
				include('error.php');
			echo 'data='.json_encode($data);
			}
		else
			{
			$page=(isset($data['changePage']))?$data['changePage']:$return;
			unset($data['changePage']);
			$hash=isset($data['hash'])?'#'.$data['hash']:'';
			unset($data['hash']);
			$query='';
			foreach($data as $key=>$value)
				{
				$query.=(strlen($query)>0)?'&':'?';
				$query.=urlencode($key).'='.urlencode($value);
				}
			header('Location: '.$page.$query.$hash);
			}
		exit;
	}
?>