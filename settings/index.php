<?php
require('../logged-in.php');
$TITLE='Settings';
$CSS="['/css/style.css','/css/icons.css']";
require('head.php');

echo '<div class="page" align="center" '.$DATA_TITLE.$DATA_CSS.$DATA_JS.'>';
?>
<div class="nav">
<table class="active">
<tr>
<th style="border-left:0px;"><a href="/"><div><</div></th>
<th style="border-right:0px;"><a href="#"><div><?php echo $TITLE; ?></div></th>
</tr>
</table>
	<table>
		<tr>
			<th style="border-left:0px;"><a href="/"><div><span class="icon whatshot-icon"></span></div></a></th>
			<th style="border-left:0px;"><a href="/notifications"><div><span class="icon notification-icon"></span></div></a></th>
			<th style="border-left:0px;"><a href="/menu"><div>...</div></a></th>
		</tr>
	</table>
</div>

<div class="section settings">
	<ul class="white-list">
		<a href="/settings/username"><li>Change username</li></a>
		<a href="/settings/password"><li>Change password</li></a>
		<a href="/settings/profile-picture"><li>Change profile pciture</li></a>
		<a href="/settings/delete-account"><li>Delete account</li></a>
	</ul>
</div>

<?php 
if(empty($_SERVER['HTTP_X_PAGE']))
	include('../footer.php');
?>