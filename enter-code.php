<?php

require('response.php');
$return ="signup";

if(empty($_SESSION['enter-code']['number']))
	respond(['error'=>8]);

require('sql.php');
if(!$connection=mysqli_connect($SQL_DOMAIN,$SQL_USERNAME,$SQL_PASSWORD,$DB))
	respond(['error'=>5,'line'=>__LINE__]);

if(!($result=mysqli_query($connection,'SELECT number,blocked,freeze_till,code_validity FROM numbers WHERE number='.$_SESSION['enter-code']['number'])))
	respond(['error'=>5,'line'=>__LINE__]);

list($number,$blocked,$freeze_till,$code_validity)=mysqli_fetch_row($result);

if(!$number||$blocked==1||$freeze_till>0||$code_validity<time())
	respond(['changePage'=>'/']);

$TITLE="Enter Code";
$JS="['js/form.js']";
require('head.php');

echo '<div class="page" align="center" '.$DATA_TITLE.$DATA_CSS.$DATA_JS.'>';
?>
<div class="nav">
	<table class="active">
		<tr>
			<th style="border-left:0px;"><a href="signup"><div><</div></th>
			<th style="border-right:0px;"><a href="#code"><div>Enter Code</div></th>
		</tr>
	</table>
</div>

<div class="section">
	<form action="verifying-code" method="post" data-error="error">
		<div style="padding:20px;">
			<p id="error">
				<?php
					if(isset($_GET['error']))
						{
						$data=$_GET;
						include('error.php');
						echo $data['error'];
						}
					elseif(isset($_GET['r']))
						{
				?>
				A code was sent to your number earlier, please enter that code. If you haven't yet recived any code wait for <?php echo round((($code_validity-time())/60)).' minutes';?> and try <?php if(isset($_GET['s']))echo 'signing in';if(isset($_GET['l']))echo 'logging in'; ?> again
				<?php
						}
				?>
			</p>
			<p>Enter the code that we sent to your number</p>
			<label>Your mobile number:</label>
			<input type="number" name="number" <?php echo "value=\"".$_SESSION['enter-code']['number']."\"";?> disabled>
			<label>Enter the verification code:</label>
			<input type="number" name="code" id="code">
			<div align="center" style="padding:20px;">
				<input type="submit" value="CONTINUE" />
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