<?php 
if(empty($_SERVER['HTTP_X_PAGE']))
	{
?>
<!doctype html>
<html>
<head>
<title data-string="$title$"><?php echo $TITLE;?></title>
<meta name="viewport" content="width=device-width, initial-scale=1"/>
<link rel="stylesheet" href="/css/base.css">
<script id="js-injection">
(function()
	{
	var s=document.getElementsByTagName('script'),i=0;
	for(;i<s.length;i++)
		if(s[i].getAttribute('src')!='/js/js.js'&&s[i].id!="js-injection")
			{
			window.location="js_injected.php";
			alert("We have encountered an unknown handler, please click on OK to know more.");
			}
	})();
</script>
<script src="/js/js.js"></script>
<?php 
if(isset($CSS))
	{
	$NCSS=json_decode(preg_replace('/\'/','"',$CSS));
	for($i=0;$i<count($NCSS);$i++)
		echo '<link rel="stylesheet" href="'.$NCSS[$i].'">';
	}
$DATA_TITLE="";
$DATA_CSS="";
$DATA_JS=(isset($JS))?" data-js=\"".$JS."\" ":"";
?>
</head>
<body>
<?php 
	}
else
	{
	$DATA_TITLE=(isset($TITLE))?" data-title=\"".$TITLE."\" ":"";;
	$DATA_CSS=(isset($CSS))?" data-css=\"".$CSS."\" ":"";;
	$DATA_JS=(isset($JS))?" data-js=\"".$JS."\" ":"";
	}
?>