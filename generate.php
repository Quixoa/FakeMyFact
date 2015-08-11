<?
$HEADLINE = $_POST["headline"];
$SENTENCE = $_POST["sentence"];
$KEYWORD = $_POST["keyword"];

echo '<link rel="icon" 
      type="image/png" 
      href="http://d0od.wpengine.netdna-cdn.com/wp-content/uploads/2012/08/favicon.png">' ;


$KEYWORD = str_replace(" ","_",$KEYWORD);

$wiki = file_get_contents('http://en.wikipedia.com/wiki/'.$KEYWORD);
$dom = new DomDocument();
@$dom->loadHTML($wiki);
$wiki = $dom->getElementsByTagName('p')->item(0)->nodeValue;
$p1 = preg_replace('/[^a-zA-Z\s]/', '', $wiki);
$KEYWORD = str_replace("_"," ",$KEYWORD);
if(empty($KEYWORD)){
	echo '<h1>ERROR, ALL FIELDS MUST BE FILLED</h1>';
	
}else{
if(strcmp($_POST["type"],'News') == 0){
	$googlepage = file_get_contents('Google-Pop.html');
	$googlepage = str_replace("INSERT_HEADLINE", $HEADLINE, $googlepage);
	$googlepage = str_replace("INSERT_WIKI", substr($p1,0,150)."...", $googlepage);
	$googlepage = str_replace("INSERT_SENTENCE", $SENTENCE, $googlepage);
	$googlepage = str_replace("INSERT_KEYWORD1", $KEYWORD, $googlepage);
	echo $googlepage;
}
if(strcmp($_POST["type"],'Sports') == 0){
	$googlepage = file_get_contents('Google-Sports.html');
	$googlepage = str_replace("INSERT_HEADLINE", $HEADLINE, $googlepage);
	$googlepage = str_replace("INSERT_WIKI", substr($p1,0,150)."...", $googlepage);
	$googlepage = str_replace("INSERT_SENTENCE", $SENTENCE, $googlepage);
	$googlepage = str_replace("INSERT_KEYWORD", $KEYWORD, $googlepage);
	echo $googlepage;
}
if(strcmp($_POST["type"],'History') == 0){
	$googlepage = file_get_contents('HistoryDotCom.html');
	$googlepage = str_replace("INSERT_HEADLINE", $HEADLINE, $googlepage);
	$googlepage = str_replace("INSERT_WIKI", substr($p1,0,150)."...", $googlepage);
	$googlepage = str_replace("INSERT_SENTENCE", $SENTENCE, $googlepage);
	$googlepage = str_replace("INSERT_KEYWORD", $KEYWORD, $googlepage);
	echo $googlepage;
}
if(strcmp($_POST["type"],'CNN') == 0){
$KEYWORD = str_replace(" ","_",$KEYWORD);
	$jsrc = "https://ajax.googleapis.com/ajax/services/search/images?v=1.0&q=".$KEYWORD;
	$json = file_get_contents($jsrc);
	$jset = json_decode($json, true);
	$imageURL =  $jset["responseData"]["results"][0]["url"];
	$KEYWORD = str_replace("_"," ",$KEYWORD);
	$googlepage = file_get_contents('CNN.html');
	$googlepage = str_replace("INSERT_HEADLINE", $HEADLINE, $googlepage);
	$googlepage = str_replace("INSERT_WIKI", $p1, $googlepage);
	$googlepage = str_replace("INSERT_SENTENCE", $SENTENCE, $googlepage);
	$googlepage = str_replace("INSERT_KEYWORD", $KEYWORD, $googlepage);
	$googlepage = str_replace("INSERT_IMAGE", '<img class="cnnStryVidCont" src="'.$imageURL.'"/>', $googlepage);
	echo $googlepage;
}
}


?>