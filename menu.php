<?php
require('logged-in.php');

$TITLE='Menu';
$CSS="['css/style.css','css/icons.css']";
$JS="['js/posttime.js','js/tags.js','js/search.js']";
require('head.php');

echo '<div class="page" align="center" '.$DATA_TITLE.$DATA_CSS.$DATA_JS.'>';

?>
<div class="nav">
	<table class="active" style="border-bottom:1px solid #999;">
		<tr>
			<th style="border:0px;"><div data-string="$title$"><?php echo $TITLE; ?></div></th>
			<th style="width:10%" id="search"><a href="search" id="search"><div><span class="icon search-icon"></span></div></th>

		</tr>
	</table>
	<table>
		<tr>
			<th style="border-left:0px;"><a href="/"><div><span class="icon whatshot-icon"></span></div></a></th>
			<th style="border-left:0px;"><a href="notifications"><div><span class="icon notification-icon"></span></div></a></th>
			<th style="border-left:0px;" class="active" ><a href="menu"><div>...</div></a></th>
		</tr>
	</table>
</div>
<div class="section menu">
	<ul class="white-list">
		<a href="profile"><li><span class="icon account-icon"></span>Profile</li></a>
		<a href="settings"><li><span class="icon settings-icon"></span>Settings</li></a>
		<a href="report"><li><span class="icon report-icon"></span>Report a bug</li></a>
		<a href="logout"><li><span class="icon logout-icon"></span>Logout</li></a>
	</ul>
</div>
<?php 
	if(empty($_SERVER['HTTP_X_PAGE']))
		{
		include('footer.php');
		}
?>