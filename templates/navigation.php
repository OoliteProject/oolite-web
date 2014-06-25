<ul><?php
$pages = array(
	"/"=>"About Oolite",
	"/whatsnew/"=>"What's new?",
	"/download/"=>"Download",
	"/starting/"=>"Getting started",
//	"/faq/"=>"Frequently asked questions",
	"/gallery/"=>"Screenshots",
	"/oxps/"=>"Expansion Packs",	
	"/community/"=>"Community"
	);
if (defined("OOLITE_AUTHED_PAGE")) {
	$pages["/admin/"] = "OXP Admin";
}
$current = str_replace("index.php","",$_SERVER['PHP_SELF']);
foreach($pages as $url => $link) {
	if ($url == $current) {
		if (count($_POST) == 0 && count($_GET) == 0) {
			print ("<li class='selected'>$link</li>\n");
		} else {
			print ("<li class='selected'><a href='".OO_NAV_BASE."$url'>$link</a></li>\n");
		}
	} else {
		print ("<li><a href='".OO_NAV_BASE."$url'>$link</a></li>\n");
	}
}
?></ul>
