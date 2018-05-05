<meta name="viewport" content="width=device-width, initial-scale=1"/>
<link rel="stylesheet" href="css/form.css">
<div class="page" align="center">
	<table class="active">
		<tr>
			<th style="border-left:0px;"><a href="<?php echo $_SERVER["HTTP_REFERER"];?>"><div><</div></th>
			<th style="border-right:0px;"><a href="#id"><div>Set ID and Password</div></th>
		</tr>
	</table>
	<div class="section">
		<form action="process_verify_code.php" method="post">
			<div style="padding:20px;">
				<?php 
					if(isset($_GET['m']))
						echo '<p style="text-align:center"><b class="red">'.decode($_GET['m']).'</b></p>';
				?>
				<p>Enter an unique identity for your account. You can log in to your account using your id and password.</p>
				<label>Enter ID:</label>
				<input type="text" name="id" id="id">
				<label>Enter Password:</label>
				<input type="password" name="password" id="password">
				<div align="center" style="padding:20px;">
					<input type="submit" value="CONTINUE" />
				</div>
			</div>
		</form>
	</div>
	<div class="footer">&copy;2016 B-Buzz Corporation</div>
</div>