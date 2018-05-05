<?php
require('../logged-in.php');
$TITLE='Delete account';
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
	<b>Are you sure you want to delete your account</b>
	<input type="radio" name="delete-account" id="delete-account-yes" value="yes"><label for="delete-account-yes">Yes</label>
	<input type="radio" name="delete-account" id="delete-account-no" value="no"><label for="delete-account-no">No</label>
</div>

<?php 
if(empty($_SERVER['HTTP_X_PAGE']))
	include('../footer.php');
?>