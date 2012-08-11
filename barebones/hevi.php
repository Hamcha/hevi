<?php 

/* hevi 03/1	*/
/*	barebones	*/

require "globals.php";

function hevi_load_ns($node)
{
	global $namespaces;
	$namespaces = $node->getNamespaces(true);
	foreach($namespaces as $name => $url)
	{
		include_once $url;
	}
}

function hevi_load($file)
{
	$xml = simplexml_load_file($file);
	return $xml;
}

function hevi_cache($file,$data)
{
	$handle = file_put_contents("./".$file.".xml.cache",$data);
}

function hevi_parse($node)
{
	global $globals, $content, $page_to_load;
	if (USE_CACHE) ob_start();
	foreach ($node as $element => $content)
	{
		$namespaces = $content->getNamespaces(true); 
		foreach($namespaces as $name => $ns) {
		  foreach ($content->children($ns) as $function => $arg)
		  {
		  	call_user_func_array($name."_".$function,array($arg));
		  }
		}
		
		include("theme/".$element.".php");
	}
	if (USE_CACHE)
	{
		$content = ob_get_contents();
		ob_end_clean();
		hevi_cache($page_to_load, $content);
		echo $content;
	}
}