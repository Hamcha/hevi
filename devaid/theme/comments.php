<?
$parameters = $content->attributes();

$content->addAttribute("color","#42a9c5");
$content->title = "Comments";
$content->addAttribute("md","no");
$params = "a=get&art=".urlencode($PageName);
$content->content = "<div id=\"commentbox\">Loading...</div>
<script>
$.get('libs/comments.php?".$params."', function(data) {
  $('#commentbox').html(data);
});
</script>";

include "block.php";

// Add Comment box

$content->title = "Wanna say something?";
$content["color"] = "#5446ec";
$param = "art=".$PageName;

$fullurl = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') ? 'https://' : 'http://';
$fullurl .= $_SERVER['SERVER_PORT'] != '80' ? $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"] : $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
if (!isset($loggedin) || !$loggedin)
{
		$content->content = "<div id=\"loggedas\">You must be logged in to comment<br />
		
<a href=\"?authenticate=1&amp;service=twitter&amp;from=$fullurl\"><div class=\"authbtn\">Sign In with Twitter</div></a> <a href=\"?authenticate=1&amp;service=google&amp;from=$fullurl\"><div class=\"authbtn\">Sign In with Google+</div></a>

</div></div>";
}
else
{
$aservice = $_SESSION["service"];

$content->content = <<<COMMENTFORM
<div id="loggedas">You are logged in as <b>{$username}</b> (using {$aservice}) <a href="?wipe=do&amp;from=$fullurl">Logout</a></div>
<small>You can use <a href="http://daringfireball.net/projects/markdown/syntax/">Markdown editing</a> for rich-text stuff</small>
<div id="goodstuff">
<form method="POST" action="libs/comments.php" onsubmit="return postComment(this)">
<textarea name="comment"></textarea>
<input type="hidden" name="service" value="{$aservice}" /><br />
<input type="hidden" name="username" value="{$username}" />
<input type="hidden" name="uid" value="{$uid}" />
<input type="hidden" name="aname" value="{$PageName}" />
<input type="hidden" name="returi" value="{$fullurl}" />
<input type="hidden" name="a" value="send" />
<input type="submit" value="Submit" />
</div>
</form>
COMMENTFORM;
}

include "block.php";