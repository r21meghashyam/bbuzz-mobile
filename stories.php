<?php
require('logged-in.php');

if(!($result=mysqli_query($connection,'SELECT username from users where id='.$_SESSION['id'])))
	respond(['error'=>5,'line'=>13]);

list($username)=mysqli_fetch_row($result);

$TITLE='Stories';
$CSS="['css/style.css','css/icons.css']";
$JS="['js/posttime.js','js/tags.js']";
require('head.php');

echo '<div class="page" align="center" '.$DATA_TITLE.$DATA_CSS.$DATA_JS.'>';
?>
<div class="nav">
	<table class="active" style="border-bottom:1px solid #999;">
		<tr>
			<th style="border:0px;"><div data-string="$title$"><?php echo $TITLE; ?></div></th>
		</tr>
	</table>
	<table>
		<tr>
			<th style="border-left:0px;" class="active" ><a href="/"><div><span class="icon whatshot-icon"></span></div></a></th>
			<th style="border-left:0px;"><a href="notifications"><div><span class="icon notification-icon"></span></div></a></th>
			<th style="border-left:0px;"><a href="menu"><div>...</div></a></th>
		</tr>
	</table>
</div>
<div class="section">
	<b data-string="Hello $username$">Hello <?php echo $username;?></b>
</div>
<?php 
	if(empty($_SERVER['HTTP_X_PAGE']))
		include('footer.php');
?>