<html>
<head>
<title>JS Injection</title>
<meta name="viewport" content="width=device-width, initial-scale=1"/>
<link rel="stylesheet" href="css/form.css">
</head>
<body>
<div  class="page" align="center">
<table class="active">
		<tr>
			<th style="border-left:0px;"><a href="<?php echo (isset($_SERVER["HTTP_REFERER"]))?$_SERVER["HTTP_REFERER"]:'javascript:history.back()';?>"><div><</div></th>
			<th style="border-right:0px;"><a href="#code"><div>Script Injection occured</div></th>
		</tr>
	</table>
<div class="section">
<div style="padding:20px;">
Your browser might have enabled an extension or a plugin on this site. We dont entertain any extensions or plugins for now for your privacy and security. We will look forword for this feature in the future. Please disable the feature and reload the page.
</div>
</div>
<div class="footer">&copy;2016 B-Buzz Corporation</div>
<?php
if(empty($_SERVER['HTTP_X_PAGE']))
	{
	include('footer.php');
	}
?>