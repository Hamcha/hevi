<?php

require "../globals.php";
if (USE_MARKDOWN) include "../external/markdown.php";

foreach ($_POST as $key => $value)
	$$key = $value;
	
function getServiceUrl($service,$uname,$uid = null)
{
	if ($service == "twitter")
		return "http://twitter.com/".$uname;
	if ($service == "google")
		return "https://plus.google.com/u/0/".$uid;
	return "NULL";
}

function getAllComments() {
   $url = 'https://api.mongolab.com/api/1/databases/website/collections/comments?q='.urlencode('{"article": "'.urlencode($_GET["art"]).'"}').'&apiKey=5012ec89e4b0554605905e8c';
   
   $data = file_get_contents($url);
   
   return $data;
}

function postNewComment()
{
	foreach ($_POST as $key => $value)
		$$key = $value;
	$params = array ('article' => urlencode($aname), 'user' => $username, 
	'comment' => $comment, 'time' => time(), 'service' => $service, 'uid' => $uid);
	$query = json_encode($params);
	
	$url = 'https://api.mongolab.com/api/1/databases/website/collections/comments?apiKey=5012ec89e4b0554605905e8c';
	$c = curl_init ($url);
	curl_setopt ($c, CURLOPT_POST, true);
	curl_setopt ($c, CURLOPT_POSTFIELDS, $query);
	curl_setopt ($c, CURLOPT_HTTPHEADER, array(                                                                          
    'Content-Type: application/json',                                                                       
    'Content-Length: ' . strlen($query),
    ) );
	curl_setopt ($c, CURLOPT_RETURNTRANSFER, true);
	$page = curl_exec ($c);
	curl_close ($c);
	
	return $page;
}

if ($_GET["a"] == "get")
{
	include_once '../external/Google/apiClient.php';
	include_once '../external/Google/contrib/apiPlusService.php';
	
	$client = new apiClient();
	$client->setApplicationName('Google+ PHP Starter Application');
	$client->setClientId('109223068668.apps.googleusercontent.com');
	$client->setClientSecret('HhLRk9qp10tHV93URyFr_x5e');
	$client->setRedirectUri("http://www.hamcha.net/?redirect=do");
	$client->setDeveloperKey('AIzaSyBOM6goOTONfDLBECikmzyWnYHTSPHmb4I
	');
	$plus = new apiPlusService($client);

	$data = json_decode(getAllComments());
	
	
	foreach ($data as $comment):
		$comment->uid = (isset($comment->uid))?$comment->uid:null;
		$serviceurl = getServiceUrl($comment->service,$comment->user,$comment->uid);
	?>
	<div class="commentbox">
	<div class="cimagebox">
	<? if ($comment->service == "twitter"): ?>
	<img src="https://api.twitter.com/1/users/profile_image?screen_name=<?=$comment->user;?>&size=normal" />
	<? elseif ($comment->service == "google"):
	$ppl = $plus->people->get($comment->uid);
	?>
	<img src="<?=$ppl["image"]["url"]?>" style="width:48px; height:48px;" />
	<? endif; ?>
	</div>
	<div class="author"><a href="<?=$serviceurl?>"><?=$comment->user;?></a> wrote on <?=date("M jS Y \a\\t G:i",$comment->time);?></div>
	<div class="ccontent">&nbsp;&nbsp;<?=(USE_MARKDOWN)?Markdown($comment->comment):$comment->comment?></div>
	<div style="clear:both;">&nbsp;</div>
	</div>
	<?php
	endforeach;
}
else if (isset($_POST["a"]))
{
	if ($_POST["a"] == "send")
	{
		postNewComment();
		header("location: " . $returi);
	}
} 