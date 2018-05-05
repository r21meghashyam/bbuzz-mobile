<?php
require('logged-in.php');

$TITLE='Notifications';
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
			<th style="border-left:0px;"><a href="/"><div><span class="icon whatshot-icon"></span></div></a></th>
			<th style="border-left:0px;" class="active" ><a href="notifications"><div><span class="icon notification-icon"></span></div></a></th>
			<th style="border-left:0px;"><a href="menu"><div>...</div></a></th>
		</tr>
	</table>
</div>
<div class="section notifications">
	<?php /*
	<ul>
	<?php require('posttime.php'); ?>
		<a href="#"><li>ABC liked your photo<br><small data-posttime="<?php echo 1462010557;?>"><?php echo posttime(1462010557);?></small></li></a>
		<a href="#"><li>ABC liked your photo<br><small data-posttime="<?php echo 1462010557-100000;?>"><?php echo posttime(1462010557-100000);?></small></li></a>
		<a href="#"><li>ABC started following you.<br><small data-posttime="<?php echo 1462010557-1000000;?>"><?php echo posttime(1462010557-1000000);?></small></li></a>
	</ul> */?>
	<div style="text-align:center;"><i>No Notifications</i></div>
</div>
<?php 
if(empty($_SERVER['HTTP_X_PAGE']))
	{
	include('footer.php');
	}
?>