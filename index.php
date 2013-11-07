<?php 

// grab the url
if(isset($_REQUEST['url'])) $url = $_REQUEST['url']; 
else $url = false;

// no looking at my source code!
if($url && substr($url,0,7) != "http://") exit("Please start urls with 'http://'");
		
// make the stylesheet link
$xsl_file = 'xsl.php';
if($url) $xsl_file .= '?url='.urlencode($url);
define('XSL_LINK','<?xml-stylesheet href="'.$xsl_file.'" type="text/xsl" ?>');

// if we don't have a url, use the home page
if(!$url) $url = "home.xml";

// download the rss feed
$rss = file_get_contents($url);

// xml header so firefox doesn't decide it's text
header('content-type: text/xml');

//echo out the header right away, if there is one
if(substr($rss,0,6) == '<?xml '){
	$header_end = strpos($rss,'?>') +2;
	echo substr($rss,0,$header_end);
	$rss = substr($rss,$header_end);
}
//otherwise echo a default header:
else echo '<?xml version="1.0" ?'.'>';

// remove any existing stylesheet
//$rss = preg_replace('/<\?xml-stylesheet [^?]*?'.'>/','',$rss); // won't work if there's a ? in the tag somewhere
$rss = preg_replace('/<\?xml-stylesheet([^?]|\?(?!>))*\?'.'>/','',$rss);  // uses lookahead

// add in our stylesheet
echo "\r\n" . XSL_LINK . "\r\n";

// toss in >512 bytes of nothing to hopefully throw off firefox & ie's rss previewer
echo "                                                                                                                                                                                                                                                            	                                                                                                                                                                                                                                                                                                                                                                                                                                    ";

//finally, pass along the content
echo $rss;

?>