<?php 

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
	
	/* HACKS LOADING (WIP) */
	if (file_exists("hacks/loaded.cfg.xml"))
	{
		$hacks = simplexml_load_file("hacks/loaded.cfg.xml");
		foreach ($hacks as $element => $content)
		{
			include $content;
		}
	}
	/* END HACKS */
	
	return $xml;
}

function hevi_cache($file,$data)
{
	$handle = file_put_contents("./cache/".$file.".xml.cache",$data);
}

function hevi_parse($node)
{
	global $globals, $content, $page_to_load;
	if (USE_CACHE) ob_start();
	foreach ($node as $element => $content)
	{
		
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