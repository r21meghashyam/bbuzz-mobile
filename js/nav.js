(function()
	{
	var d=document,a=d.getElementsByTagName('a'),i,j;
	for(i=0;i<a.length;i++)
		{
		removeEvent(a[i],'click',alink);
		if(a[i].hasAttribute('data-section'))
			{
			addEvent(a[i],'click',function(e)
				{
				var opened,i,section=this.getAttribute('data-section'),th;
				e.preventDefault();
				opened=activePage().className.match(/open\-\w*/ig);
				if(opened)
					for(i=0;i<opened.length;i++)
						activePage().classList.remove(opened[i]);
				activePage().classList.add('open-'+section);
				tag('title',this.getAttribute('data-title'));
				th=this.parentElement.parentElement.getElementsByTagName('th');
				for(i=0;i<th.length;i++)
					th[i].classList.remove('active');
				this.parentElement.classList.add('active');
				d.getElementById('back').classList.add('hidden');
				history.pushState({page:section},true,section);
				}
			);
			}
		else
			{
			addEvent(a[i],'click',function(e)
				{
				e.preventDefault();
				ajax(this.href,
				{
				success:function(data,status,url)
					{
					if(data.substr(0,4)=="data")
						{
						action(data);
						return;
						}
					var div=data.match(/\<div[\w\s\-\'\"\\=\/\\\:\.\,\[\]]*class[\s\-\'\"\\=]*\s?section\s?[\w\s\-\'\"\\=\/\\\.\,\:\[\]]*\>/i)[0],
					attributes=div.replace(/\<div/i,'').replace(/\>/i,'').trim().match(/[\w||\-]+="[^\"]+"/gi),
					attributesList={},
					i=0,k,_class,opened,section;
					
					for(;i<attributes.length;i++)
						{
						k=attributes[i].split("=");
						attributesList[k[0]]=k[1].substr(1,k[1].length-2);
						}
					if(attributesList["data-title"])
						{
						tag('title',attributesList['data-title']);
						delete attributesList['data-title'];
						}
					if(attributesList["data-js"])
						{
						activePage().setAttribute('data-js',attributesList['data-js']);
						delete attributesList['data-js'];
						}
					if(attributesList["data-css"])
						{
						activePage().setAttribute('data-css',attributesList['data-css']);
						delete attributesList['data-css'];
						}
					d.getElementById('back').classList.remove('hidden');
					history.pushState({page:url},true,url);
					opened=activePage().className.match(/open\-\w*/ig);
					if(opened)
						for(i=0;i<opened.length;i++)
							activePage().classList.remove(opened[i]);
					_class=attributesList['class'].split(' ');
					for(i=0;i<_class.length;i++)
						{
						if(_class[i]=="section")continue;
						activePage().classList.add('open-'+_class[i]);
						}
					
					section=data.replace(div,"").trim();
					section=section.substr(0,section.length-6).trim();
					div=d.createElement('div');
					for(i in attributesList)
						div.setAttribute(i,attributesList[i]);
					div.innerHTML=section;
					activePage().insertBefore(div,d.getElementsByClassName('footer')[0]);  
					pageInit();
					},
				loader:true
				});
				});
			}
		}
	}
)();