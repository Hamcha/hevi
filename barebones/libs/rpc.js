function RPC(url)
{
	this.url = url;
	this.call = function(fname,args,callback)
	{
		$.post(url+"?a=rpc_call",{ "function": fname, "args" : args },function(data)
		{ callback($.parseJSON(data)); });
	};
}
