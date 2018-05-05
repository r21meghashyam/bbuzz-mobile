<?php
if(isset($_SESSION["id"]))
	{
	include('stories.php');
	}
else
	{
	if(isset($_SERVER['HTTP_X_PAGE']))
		echo 'data={"changePage":"login"}';
	else
		header('Location: login.php');
	}
?>