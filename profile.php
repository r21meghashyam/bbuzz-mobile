<?php
require('logged-in.php');

if(!($result=mysqli_query($connection,'SELECT username from users where id='.$_SESSION['id'])))
	respond(['error'=>5,'line'=>13]);

list($username)=mysqli_fetch_row($result);

$TITLE=$username;
$CSS="['css/style.css','css/icons.css']";
$JS="['js/posttime.js','js/tags.js']";
require('head.php');

echo '<div class="page" align="center" '.$DATA_TITLE.$DATA_CSS.$DATA_JS.'>';
?>
<div class="nav">
<table class="active">
<tr>
<th style="border-left:0px;"><a href="<?php echo (isset($_SERVER["HTTP_REFERER"]))?$_SERVER["HTTP_REFERER"]:'/';?>"><div><</div></th>
<th style="border-right:0px;"><a href="#"><div><?php echo $TITLE; ?></div></th>
</tr>
</table>
	<table>
		<tr>
			<th style="border-left:0px;"><a href="/"><div><span class="icon whatshot-icon"></span></div></a></th>
			<th style="border-left:0px;"><a href="notifications"><div><span class="icon notification-icon"></span></div></a></th>
			<th style="border-left:0px;"><a href="menu"><div>...</div></a></th>
		</tr>
	</table>
</div>
	
<div class="section profile" <?php echo $DATA_TITLE.$DATA_CSS.$DATA_JS?>>
	<table style="width:100%;">
		<tr>
			<td style="width:30%;"><img src="user.png"/></td>
			<td valign="top">
				<ul style="list-style-type:none;margin-top:20px;">
					<li><b>Meghashyam Bhandary</b></li>
					<li><i>@<?php echo $username; ?></i></li>
					<li><i>Hey folks, Whats cooking?</i></li>
				</ul>
			</td>
		</tr>
	</table>
</div>
<?php 
if(empty($_SERVER['HTTP_X_PAGE']))
	include('footer.php');
?>