<?php
require('response.php');

if(isset($_SESSION['id']))
	{
	$a=Array('changePage'=>'/');
	respond($a);
	}
$TITLE="Login";
$JS="['js/form.js']";

require('head.php');
?>

<?php
echo '<div class="page" align="center" '.$DATA_TITLE.$DATA_CSS.$DATA_JS.'>';
?>
<div class="nav">
	<table>
		<tr>
			<th style="border-left:0px;" class="active"><a href="#username" ><div>Login</div></th>
			<th style="border-right:0px;"><a href="signup"><div>Signup</div></th>
		</tr>
	</table>
</div>

<div class="section">
	<form action="logging-in" method="post" data-error="error">
		<div style="padding:20px;" >
			<p id="error">
				<?php
					if(isset($_GET['error']))
						{
						$data=$_GET;
						include('error.php');
						echo $data['error'];
						}
				?>
			</p>
			<div>
				<label for="username">Enter your identity  name:</label>
				<input type="text" name="username" id="username" class="input" <?php if(isset($_GET['username']))echo 'value="'.$_GET['username'].'"';?> />
			</div>
			<div>
				<label for="password">Enter your password:</label>
				<input type="password" name="password" id="password" class="input">
			</div>
			<a href="forgot-password">Forgot password</a>
			<div align="center" style="padding:20px;">
				<input type="submit" value="LOGIN" />
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