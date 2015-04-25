<div class='oxpnews'>
		<h2>Latest Expansion Releases...</h2>
		<ul>
<?php		  
try {
$oxzs = getOXZs("d");
for ($i=0;$i<5;$i++) {
	$oxz = $oxzs->fetch();
	print ("<li>");
	if ($oxz['information_url'] != "")
	{
		print ("<a href='".$oxz['information_url']."'>");
	}
	print (htmlspecialchars($oxz['title'])." ".htmlspecialchars($oxz['version']));
	if ($oxz['information_url'] != "")
	{
		print ("</a>");
	}
	print (" <span class='newsdate'>".date("j F Y",$oxz['released'])."</span>");
	print ("</li>\n");
}
} catch (Exception $e) {
    print ("<li>Unable to load release list</li>");
}
?>
		</ul>
</div>