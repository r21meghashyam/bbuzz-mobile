//Coded my Meghashyam Bhandary(r21meghashyam@yahoo.in)
"use strict";
(function(){
    var d=document,w=window;
	w.scripts={};
	w.scriptActive={};
	w.Rdata=function(d)
		{
			return d.replace('<!-- Hosting24 Analytics Code -->\n\r<script type="text/javascript" src="http://stats.hosting24.com/count.php"></script>\n\r<!-- End Of Analytics Code -->','').trim();
		}
	w.fullPath=function(path)
		{
		var l=location,
			url,
			i=0,
			dirs=l.pathname.split('/');
		if(!path)
			return l.href;
		if(path[0].match(/[^\/||\.]/i))
			path="./"+path;
		if(path[0]=='/')
			dirs='/';
		while(path.substr(0,1)=='.')
			{
			dirs.pop();
			path=path.substr(1,path.length-1);
			}
		
		url=l.protocol+'//'+l.host;
		
		for(;i<dirs.length;i++)
			{
			if(dirs[i].length>0)
				url+='/'+dirs[i];
			}
		return url+path;
		}
	w.activePage=function()
		{
		return d.getElementsByClassName('page')[0];
		}
	scripts[fullPath('js/js.js')]=1;
	scriptActive[fullPath('js/js.js')]=1;
	w.ajax=function(url,o)
		{
		if(typeof(url)=='undefined')
			{
			throw "URL not specified";
			return false;
			}
		var h=(XMLHttpRequest)?new XMLHttpRequest():new ActiveXObject("Microsoft.XMLHTTP"),
			o=o||{},p;
			o.method=(o.method)?o.method:"GET";
		if(typeof(o.before)=='function')
				o.before(h,o,url);
		h.onreadystatechange=function()
			{
			if(h.readyState==4&&h.status==200&&typeof(o.success)=='function')
				o.success(Rdata(h.responseText),h.status,url);
			if(h.readyState==4&&(h.status==404||h.status==500)&&typeof(o.fail)=='function')
				o.fail(h.readyState,h.status);
			if(typeof(o.change)=='function')
				o.change(h,url);
			if(typeof(o.after)=='function'&&h.readyState==4)
				o.after(Rdata(h.responseText),h,url);
			//if(console)console.clear();
			};
		console.log(o.method);
		h.open((o.method.toUpperCase()=="POST")?"POST":"GET",url,true);
		h.setRequestHeader('X-Page','true');
		if(o.method.toUpperCase()=="POST")
			h.setRequestHeader("Content-type","application/x-www-form-urlencoded");
		for(i in o.headers)
			h.setRequestHeader(i,o.headers[i]);
		h.send(o.data);
		}
	
	w.loader=function()
		{
		var l=d.getElementsByClassName('load-screen')[0];
		if(l)
			return l;
		l=createNode(d.body,'div',{'class':'load-screen hidden'});
		createNode(l,'div',{'class':'loader'});
		return l;
		}
	w.error=function(t)
		{
		var e=d.getElementsByClassName('error')[0];
		if(!e)
			{
			e=createNode(activePage(),'div',{'class':'error hidden'});
			createNode(e,'div',{'class':'icon'},'X');
			createNode(e,'div',{'class':'text'},'');
			}
		if(t)e.getElementsByClassName('text')[0].innerHTML=t;
		e.classList.remove('hidden');
		setTimeout(function(){e.classList.add('hidden');},2990);
		return e;
		}
	w.loadScript=function(s)
		{
		var k=0,j,load;
		if(typeof(s)!='object')s=[s];
		for(;k<s.length;k++)
			{
			s[k]=fullPath(s[k]);
			load=true;
			for(j in scripts)
				if(s[k]==j)
					{
					eval(scripts[j]);
					scriptActive[j]==1;
					load=false;
					break;
					}
			if(load)
				ajax(s[k],
					{
					success:function(code,status,url)
						{
						eval(code);
						scripts[url]=code;
						scriptActive[url]=1;
						}
					}
				);
			}
		}
	
	w.count=function(obj)
		{
		var i,c=0;
		for(i in obj)
			{
			c++;
			}
		return c;
		}
	
	w.loadStylesheet=function(s)
		{
		var i=0,j=0,link,preloaded;
		if(typeof(s)!='object')s=[s];
		for(;i<s.length;i++)
			{
			preloaded=0;
			for(j=0;j<d.styleSheets.length;j++)
				{
				if(fullPath(s[i])==d.styleSheets[j].href)
					{
					preloaded=1;
					break;
					}
				}
			if(preloaded)
				continue;
			link=d.createElement('link');
			link.href=s[i];
			link.rel="stylesheet";
			/*var si=setInterval(function()
				{
				if(d.styleSheets[d.styleSheets.length-1].href==link.href)
					{
					clearInterval(si);
					console.log(link.href+' loaded');
					}
					else
				console.warn(link.href+' not Loaded');
				},30);*/
			d.head.appendChild(link);
			};
		}
	w.removeStylesheet=function(f)
		{
		var l=d.getElementsByTagName('link'),i=0;
		for(;i<l.length;i++)
			if(l[i].getAttribute('href')==f)d.head.removeChild(l[i]);
		}
	
	
	w.addEvent=function(node,event,fn,useCapture)
		{
		(w.addEventListener)?node.addEventListener(event,fn,(useCapture)?true:false):node.attachEvent(event,fn);
		};
	w.removeEvent=function(node,event,fn,useCapture)
		{
		(w.removeEventListener)?node.removeEventListener(event,fn,(useCapture)?true:false):node.detachEvent(event,fn);
		};
	
	w.createNode=function(parentNode,tagName,attributes,childNodes)
		{
		var node=d.createElement(tagName),i;
		if(attributes)
			for(i in attributes)
				node.setAttribute(i,attributes[i]);
		if(childNodes)
			node.innerHTML=childNodes;
		parentNode.appendChild(node);
		return node;
		}
	w.alink=function(e)
		{
		e.preventDefault();
		changePage(this.href);
		}

	w.pageInit=function()
		{
		var page=activePage(),
			a=page.getElementsByTagName('a'),
			i=0,hash;
		if(!d.cookie)
			{
			window.location="nocookie.php";
			return;
			}
		if(hash=location.hash)
			{
			hash=hash.substr(1,hash.length-1);
			if(d.getElementById(hash))
				d.getElementById(hash).focus();
			}
		for(;i<a.length;i++)
			{
			if(a[i].hasAttribute('target')||a[i].href.match(/[\w]+\:\/\/[^\/]+/i)[0]!='http://'+location.host)
				{
				a[i].setAttribute('target','_blank');
				continue;
				}
			addEvent(a[i],'click',alink);
			}
		page.hasAttribute('data-css')&&loadStylesheet(eval(page.getAttribute('data-css')));
		page.hasAttribute('data-js')&&loadScript(eval(page.getAttribute('data-js')));
		}

		
	w.requires=function(s)
		{
		if(!s)return;
		var s=typeof(s)=='object'?s:[s],i;
		for(i=0;i<s.length;i++)
			if(s[i].length&&!scriptActive[s[i]])
				loadScript(s[i]);
		};
		
	w.changePage=function(link,pop)
		{
		var l=loader();
		ajax(link,
			{
			before:function()
				{
				l.classList.remove('hidden');
				},
			success:function(data)
				{
				console.log(data);
				if(data.substr(0,4)=="data")
					{
					
					action(data);
					return;
					}
				var div=data.match(/\<div[\w\s\-\'\"\\=\/\\\:\.\,\[\]]*class[\s\-\'\"\\=]*\s?page\s?[\w\s\-\'\"\\=\/\\\.\,\:\[\]]*\>/i),
					attributes,attributesList,i=0,k,page;
					if(!div)
						{
						error('Failed to load');
						return;
						}
					div=div[0];
					attributes=div.replace(/\<div/i,'').replace(/\>/i,'').trim().match(/[\w||\-]+="[^\"]+"/gi);
					attributesList={};
				for(;i<attributes.length;i++)
					{
					k=attributes[i].split("=");
					attributesList[k[0]]=k[1].substr(1,k[1].length-2);
					}
				if(attributesList["data-title"])
					d.title=attributesList['data-title'];
				createNode(d.body,'div',attributesList,data.replace(div,""));
				d.body.removeChild(activePage());
				if(!pop)
					history.pushState({page:link},true,link);
				pageInit();
				},
			fail:function()
				{
				error('Failed to load.');
				},
			after:function()
				{
				l.classList.add('hidden');
				}
			}
		);
		}
	w.action=function(d,e,c)
		{
		var data=JSON.parse(d.substr(5,d.length))||{},
			url,
			query="",
			j,hash;
		if(typeof(data.changePage)!='undefined')
			{
			url=data.changePage;
			hash=(data.hash)?"#"+data.hash:"";
			delete data.changePage;
			delete data.hash;
			for(j in data)
				{
				query+=(query.length>0)?'&':'?';
				query+=j+"="+data[j];
				}
			changePage(url+query+hash);
			}
		if(data.error&&e)
			{
			error(data.error);
			}
		if(data.call)
			{
			eval(data.call);
			}
		if(c)
			c(data);
		}

	addEvent(window,'load',function(e)
		{
		pageInit();
		},true);
	addEvent(window,'popstate',function(){changePage(location.href,true);});
	
}
)();
