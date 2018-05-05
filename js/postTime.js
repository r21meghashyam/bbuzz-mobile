"use strict";
(function()
	{
	var d=document,w=window;
	function postTimeInit(e)
		{
		var i;
		if(e.nodeType==1)
			{
			if(e.attributes&&e.attributes.length&&e.attributes[0].nodeName=="data-posttime")
				{
				e.childNodes[0].posttime=e.attributes[0].nodeValue;
				postTimeHandler(e.childNodes[0]);
				e.removeAttribute('data-posttime');
				}
			for(i=0;i<e.childNodes.length;i++)
				{
				postTimeInit(e.childNodes[i]);
				}
			}
		}
		postTimeInit(d.body);
		

		
		function postTimeHandler(e)
			{
			var date=new Date(),
				time=date.getTime()/1000|0,//SOURCE: https://coderwall.com/p/rbfl6g/how-to-get-the-correct-unix-timestamp-from-any-date-in-javascript
				posttime=e.posttime,
				gap=time-posttime,
				v,s;
			switch(true)
				{
				case gap<60:v="just now";e.interval=(60-gap)*1000;break;
				case gap<3600:v=Math.floor(gap/60)+" min ago.";e.interval=(((Math.ceil(gap/60)*60)-gap)*1000)||60000;break;
				case gap<86400:v=(s=Math.floor(gap/3600))+" hr"+(s>1?'s':'')+" ago.";e.interval=(((Math.ceil(gap/3600)*3600)-gap)*1000)||3600000;break;
				case gap<604800:v=(s=Math.floor(gap/86400))+" day"+(s>1?'s':'')+" ago.";e.interval=(((Math.ceil(gap/86400)*86400)-gap)*1000)||86400000;break;
				case gap<31449600:v=(s=Math.floor(gap/604800))+" week"+(s>1?'s':'')+" ago.";e.interval=(((Math.ceil(gap/604800)*604800)-gap)*1000)||604800000;break;
				default:v="long back";
				}
			e.nodeValue=v;
			setTimeout(function()
				{
				postTimeHandler(e);
				},
				e.interval||1000);
			}
	}
)();

