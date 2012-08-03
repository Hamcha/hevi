<?php

error_reporting(0);

function getTimeline($count, $username) {
   $url = 'http://api.twitter.com/1/statuses/user_timeline.json?screen_name='.$username.'&count='.$count;
   
   $data = file_get_contents($url);
   
   if (!$data) return "Unable to retrieve tweet due to intensive traffic";
   
   $tweets = json_decode($data,TRUE);	
   
   
   return $tweets;
}

if (!isset($_GET["account"]) || !isset($_GET["count"])) die("TWEETLIB API ERROR");

$data = getTimeline($_GET["count"],$_GET["account"]);
if (!is_array($data)) die($data);

$twparsed = "<ul class=\"lil\">";

foreach ($data as $tweet)
{
	$twparsed .= "<li>&nbsp;&nbsp;&nbsp;" . $tweet["text"] . "</li>";
}

$twparsed .= "</ul>";

echo $twparsed;