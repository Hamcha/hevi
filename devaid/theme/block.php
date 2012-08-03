<? $parameters = $content->attributes(); ?>
<div class="block" style="<?=isset($parameters->width)? "width:" . $parameters->width . "px" : "" ?>">
<h1><?=$content->title;?></h1>
<?=(USE_MARKDOWN)? Markdown($content->content) : "<p>" . $content->content . "</p>" ;?>
</div>