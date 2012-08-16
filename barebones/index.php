<?php

/* hevi 03/2	*/
/*	barebones	*/

require "hevi.php";

session_start();

/* HACKS LOADING (WIP) */
if (file_exists("hacks/onload.cfg.xml"))
{
	$hacks = simplexml_load_file("hacks/onload.cfg.xml");
	foreach ($hacks as $element => $content)
	{
		include $content;
	}
}
/* END HACKS */

// Markdown inclusion
if (USE_MARKDOWN) include "external/markdown.php";

// Quick Url Parsing
$queryurl = array_keys($_GET);
$pagename = DEFAULT_PAGE;
if (isset($queryurl[0]) && $queryurl[0] != "") $pagename = $queryurl[0];
$url_p = explode("/",$pagename);
array_shift($url_p);

if (USE_SFU) $page_to_load = str_replace("_html", "", join($url_p,"/"));
else $page_to_load = join($url_p,"/");

// Variables for use in elements
$globals = simplexml_load_file("globals.cfg.xml");
$PageName = $page_to_load;

// XML page loading
if (!file_exists($page_to_load.".xml"))
{
	header("Status: 404 Not Found");
	die("<h1>404 Page not found</h1>");
}

$filename = "./".$page_to_load.".xml";

// Check for cached version (If is enabled)
if (!USE_CACHE || !file_exists("cache/".$page_to_load.".xml.cache"))
{
	// Cached version doesn't exists / not enabled, load and parse the file
	$xml = hevi_load($filename);
	hevi_parse($xml);
} else {
	// Cached version exists! Show that one.
	echo file_get_contents("cache/".$filename.".cache");
}
