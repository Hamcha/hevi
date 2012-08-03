<div id="menu">
<?php 
$links = simplexml_load_file("links.cfg.xml");
foreach ($links->menu->link as $link):
?>
<a href="?/<?=$link->attributes()?><?=(USE_SFU)?".html":"";?>" <?=($link->attributes() == $PageName)? "class=\"active\"":""; ?>>
<?=$link?></a>
<? endforeach; ?>
</div>
