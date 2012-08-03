<? $parameters = $content->attributes(); ?>
<?php

if (!isset($parameters->resource) || !file_exists($parameters->resource.".list.xml")) 
{
	$resource = $content;
}
else
{
	$resource = simplexml_load_file($parameters->resource.".list.xml");
}

$finalcontent = "";

$limit = (isset($parameters->last))?$parameters->last:-1;

foreach ($resource as $item)
{
	if ($limit == 0) break;
	$iparams = $item->attributes();
	$finalcontent .= 
	"<a href=\"".
	((isset($iparams->link))?"?/".$iparams->link.((USE_SFU)?".html":""):"#").
	((isset($iparams->href))?$iparams->href:"")
	."\">
	<div class=\"newsitem\"><div class=\"date\">".$iparams->date."</div>".
	((USE_MARKDOWN)?Markdown($item):$item)."</div></a>";
	$limit = $limit - 1;
}
if (!isset($parameters->title)) $content->title = "News";
else $content->title = $parameters->title;
$content->addAttribute("md","no");
$content->content = $finalcontent;
	
include "block.php";