"use strict";
(function()
	{
	var w=window,d=document;
	w.exp=function(s,f)
		{
		var m=/[^\w]/i,i,n="",c;
		for(i=0;i<s.length;i++)
			{
			c=s.charAt(i);
			n+=m.exec(c)?"\\"+c:c;
			}
		return RegExp(n,(f||""));
		}
		
	w.tagInit=function(e)
		{
		var i,j,tags,m=/\$[\s\w\-\d\[\]\'\\_"]*\$/ig;
		if(e.nodeType==1)
			{
			if(e.attributes&&e.attributes.length)
				for(i=0;i<e.attributes.length;i++)
					if(e.attributes[i].nodeName=='data-string')
						if(e.childNodes[0].nodeType==3)
							{
							e.childNodes[0].string=e.attributes[i].nodeValue;
							e.removeAttribute('data-string')
							tags=e.childNodes[0].string.match(m);
							if(tags)
								{
								e.childNodes[0].tags={};
								for(j=0;j<tags.length;j++)
									e.childNodes[0].tags[tags[j]]=tags[j];
								}
							}
			for(i=0;i<e.childNodes.length;i++)
				tagInit(e.childNodes[i]);
			}
		if(e.nodeType==3&&(tags=e.nodeValue.match(m))&&!e.string)
			{
			e.string=e.nodeValue;
			e.tags={};
			for(i=0;i<tags.length;i++)
					e.tags[tags[i]]=tags[i];
			}
		}
	tagInit(d.head);
	tagInit(d.body);
		
	w.tag=function(t,v,e)
		{
		var e=e||tag(t,v,d.head)||d.body,
			i,
			$t="$"+t+"$",
			v=v||tag,
			m=exp($t),
			tags,string;
		if(e.nodeType==3&&(m.exec(e.nodeValue)||m.exec(e.string)))
			{
			e.tags[$t]=v;
			string=e.string;
			for(i in e.tags)
				string=string.replace(exp(i),e.tags[i]);
			e.nodeValue=string;
			}
		if(e.nodeType==1)
			for(i=0;i<e.childNodes.length;i++)
				tag(t,v,e.childNodes[i]);
		}
	w.add0=function(n)
		{
		return (n<10)?'0'+n:n;
		}
	w.time=function()
		{
		var d=new Date(),day,month,year,hours;
		
		tag('time',add0(d.getDate())+'-'+add0(d.getMonth())+'-'+(d.getYear()+1900)+' '+add0(d.getHours())+':'+add0(d.getMinutes())+':'+add0(d.getSeconds()));
		
		}
	setInterval(time,1000);
	}
	
)();

