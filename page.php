<?php
require('response.php');

if(isset($_SESSION['id']))
	respond(['changePage'=>'/']);
$TITLE="Title";
$JS="['js/form.js']";
if(empty($_SERVER['HTTP_X_PAGE']))
	require('head.php');
else
	require('ajax.php');
?>
<div class="nav">
	<table>
		<tr>
			<th style="border-left:0px;" class="active"><a href="#" ><div>Nav 1</div></th>
			<th style="border-right:0px;"><a href="#"><div>Nav 2</div></th>
		</tr>
	</table>
</div>
<?php
echo '<div class="page" align="center" '.$DATA_TITLE.$DATA_CSS.$DATA_JS.'>';
?>


<div class="section">
	<form action="#" method="post" data-error="error">
		<div style="padding:20px;" >
			<p id="error">
				<?php
					if(isset($_GET['error']))
						{
						$d=$_GET;
						include('error.php');
						echo $d['error'];
						}
				?>
			</p>
			<div>
				<label for="username">Label 1:</label>
				<input type="text" name="username" id="username"/>
			</div>
			<div>
				<label for="password">Label 2:</label>
				<input type="password" name="password" id="password">
			</div>
			<a href="forgot-password">Link</a>
			<div align="center" style="padding:20px;">
				<input type="submit" value="Button" />
			</div>
		</div>
	</form>
</div>
<?php 
if(empty($_SERVER['HTTP_X_PAGE']))
	{
	include('footer.php');
	}
?>