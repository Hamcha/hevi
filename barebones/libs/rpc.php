<?php

// hevi/RPC Enabler

if ($_GET["a"] == "rpc_call")
{
	$functions = get_defined_functions();
	
	if (!in_array($_POST["function"],$functions["user"]))
		die(json_encode(Array("Error"=>"Function not defined")));
		
	$out = call_user_func_array($_POST["function"],$_POST["args"]);
	die(json_encode($out));
}