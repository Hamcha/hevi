<?
$parameters = $content->attributes();

$content->addAttribute("color","#42a9c5");
$content->title = "<a style=\"color:#fff;\" href=\"http://twitter.com/".$parameters->account."\">
@" . $parameters->account . "</a>";
$content->addAttribute("md","no");
$params = "count=".$parameters->last."&account=".$parameters->account;
$content->content = "<div id=\"twitter_".$parameters->account."\">Loading...</div>
<script>
$.get('libs/tweetlib.php?".$params."', function(data) {
  $('#twitter_".$parameters->account."').html(data);
});
</script>";

include "block.php";