"use strict";
(function()
	{
	requires('js/js.js');
	var d=document,
		form=activePage().getElementsByTagName('form'),hash,i;
	
	w.formData=function(node,data)
		{
		var i=0;
		if(node.name&&node.tagName.match(/[INPUT||SELECT]/i))
			{
			if(data.length>0)data+='&';
			data+=node.name+'='+node.value;
			}
		if(node.hasChildNodes())
			for(i=0;i<node.length;i++)
				data=formData(node[i],data);
		return data;
		}
	
	for(i=0;i<form.length;i++)
		{
		var l=loader();
		addEvent(form[i],'submit',function(e)
			{
			e.preventDefault();
			ajax(this.action,
				{
				before:function()
					{
					l.classList.remove('hidden');
					},
				method:"POST",
				data:formData(this,''),
				header:{'X-Page':'true'},
				success:function(data)
					{
					action(data,d.getElementById(e.target.getAttribute('data-error')));
					},
				fail:function()
					{
					error('Some error occured!');
					},
				after:function(data)
					{
					//data=eval(Rdata(data));
					if(!data.changePage)
						l.classList.add('hidden');
					}
				});
			}
		);
		}
	}
)();