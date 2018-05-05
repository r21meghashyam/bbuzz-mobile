<?php
if(isset($_SERVER["HTTP_COOKIE"]))
	header('Location: /');
session_start();
function output($d){require('output.php');}
?>
<!doctype html>
<html>
<head>
<title>No cookies</title>
<meta name="viewport" content="width=device-width, initial-scale=1"/>
<link rel="stylesheet" href="css/base.css">
</head>
<body>
<div class="page">
<div class="nav">
	<table>
		<tr>
			<th style="border-left:0px;" class="active"><a href="#username" ><div>No cookies</div></th>
		</tr>
	</table>
</div>

<div class="section">
	<div style="padding:20px;" >
		<p>Your browser either does not support cookies or cookies might be disabled in your browser. Please enable cookies through settings and refesh the page to continue.</p>
		<div style="text-align:center;padding:5px;"><a href="" style="background:#999;color:#FFF;padding:5px;text-decoration:none;border-radius:6px;">Refresh</a></div>
	</div>
</div>

<?php 
if(empty($_SERVER['HTTP_X_PAGE']))
	{
	include('footer.php');
	}
?>