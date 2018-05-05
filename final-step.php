<?php 

$return="signup";
require('response.php');

if(empty($_SESSION['final-step']['number'])||empty($_SESSION['final-step']['code']))
	respond(['changePage'=>'/']);

require('sql.php');

if(!$connection=mysqli_connect($SQL_DOMAIN,$SQL_USERNAME,$SQL_PASSWORD,$DB))
	respond(['error'=>5,'line'=>__LINE__]);
	
if(!($result=mysqli_query($connection,'SELECT number,blocked,freeze_till,id FROM numbers WHERE number='.$_SESSION['final-step']['number'])))
	respond(['error'=>5,'line'=>__LINE__]);

list($number,$blocked,$freeze_till,$id)=mysqli_fetch_row($result);
if(!$number||$blocked||$freeze_till>0||$id)
	respond(['changePage'=>'/']);

function title($t)
	{
	if(strlen($t)>18)
		$t=substr($t,0,15).'...';
	return $t;
	}
$TITLE="Final Step: Set Username and Password";
$JS="['js/form.js']";
require('head.php');

echo '<div class="page" align="center" '.$DATA_TITLE.$DATA_CSS.$DATA_JS.'>';
?>
<div class="nav">
	<table class="active">
		<tr>
			<th style="border-left:0px;"><a href="signup.php"><div><</div></th>
			<th style="border-right:0px;"><a href="#code"><div class="small">Final Step: Set Username and Password</div></th>
		</tr>
	</table>
</div>

<div class="section">
	<form action="creating-account" method="post" data-error="error">
		<div style="padding:20px;">
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
			<p>Now you are in the final step of signing up. All you have to do is set up your own username and a password to log in to your account.</p>
			<label>Enter an username:</label>
			<input type="text" name="username" id="username">
			<label>Enter password:</label>
			<input type="password" name="password">
			<label>Confirm password:</label>
			<input type="password" name="confirm_password">
			<div align="center" style="padding:20px;">
				<input type="submit" value="Sign Up" />
			</div>
		</div>
	</form>
</div>

<div class="footer">&copy;2016 B-Buzz Corporation</div>
	<?php
		if(empty($_SERVER['HTTP_X_PAGE']))
			{
			include('footer.php');
			}
	?>