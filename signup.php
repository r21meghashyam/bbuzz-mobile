<?php
require('response.php');

if(isset($_SESSION['id']))
	respond(Array('changePage'=>'/'));

$TITLE="Sign Up";
$JS="['js/form.js']";
require('head.php');

echo '<div class="page" align="center" '.$DATA_TITLE.$DATA_CSS.$DATA_JS.'>';
?>
<div class="nav">
	<table>
		<tr>
			<th style="border-left:0px;"><a href="login"><div>Login</div></a></th>
			<th style="border-right:0px;" class="active"><a href="#number"><div>Signup</div></a></th>
		</tr>
	</table>
</div>

<div class="section">
	<form action="signing-up" method="post" data-error="error">
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
			<label for="signup">Select your mobile ISD code:</label>
			<small>*Currently supported for indian carriers only</small>
			<select name="isd" class="input">
				<option	value="91" selected>India (91)</option>
			</select>
			<label for="signup">Enter your mobile number:</label>
			<input type="number" name="number" id="number" class="input"/>
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