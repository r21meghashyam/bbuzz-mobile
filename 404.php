<?php
if(isset($_SERVER['HTTP_X_PAGE']))
	exit;
header('HTTP/1.1 200 OK');
//require('sql.php');
/*
if(!$connection=mysqli_connect($SQL_DOMAIN,$SQL_USERNAME,$SQL_PASSWORD,$DB))
	respond(['error'=>5,'line'=>10]);

if(!($result=mysqli_query($connection,'SELECT id from client where account_number='.$_SESSION['id'])))
	respond(['error'=>5,'line'=>13]);

list($username)=mysqli_fetch_row($result);
*/
$TITLE="404: Page not found";
$JS="['js/form.js']";

require('head.php');
?>

<?php
echo '<div class="page" align="center" '.$DATA_TITLE.$DATA_CSS.$DATA_JS.'>';
?>
<div class="nav">
<table class="active">
<tr>
<th style="border-left:0px;"><a href="<?php echo (isset($_SERVER["HTTP_REFERER"]))?$_SERVER["HTTP_REFERER"]:'/';?>"><div><</div></th>
<th style="border-right:0px;"><a href="#"><div><?php echo $TITLE; ?></div></th>
</tr>
</table>
</div>

<div class="section">
	<p style="padding:1%;color:#999;text-align:center;font-size:1.5em;">The page you were trying to look for has been removed or was never there.</p>
</div>
<?php 
if(empty($_SERVER['HTTP_X_PAGE']))
	{
	include('footer.php');
	}
?>