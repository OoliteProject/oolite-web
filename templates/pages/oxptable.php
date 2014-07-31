<p style="color: #aaa; margin: 0; margin-top: 0em; padding: 0em; font-size: 90%;">Click column header to sort table.</p>
<table class='oxzs'>
<tr><th><a href='./?sort=c'>Category</a></th><th><a href='./?sort=t'>Title</a></th><th><a href='./?sort=a'>Author</a></th><th><a href='./?sort=d'>Updated</a></th><th title='Download'>↓</th></tr>
<?php

function showOXZ($oxz) 
{
	print ("<tr><td>".$oxz['category']."</td><td>");
	if ($oxz['information_url'] != "")
	{
		print ("<a href='".$oxz['information_url']."'>".htmlspecialchars($oxz['title'])."</a>");
	}
	else
	{
		print (htmlspecialchars($oxz['title']));
	}
	print ("</td><td>".htmlspecialchars($oxz['author']));
	print ("</td><td>".date("Y-m-d",$oxz['released'])."</td><td>");
	$vstr = htmlspecialchars("Download ".$oxz['title']." ".$oxz['version']);
	if ($oxz['download_url'] != "")
	{
		print ("<a href='".$oxz['download_url']."'><img src='/images/template/download.png' alt=\"$vstr\" title=\"$vstr\"></a>");
	}
	print ("</td></tr>");
}

function nextOXZ($query) {
	return $query->fetch();
}

$oxzs = getOXZs(isset($_GET['sort'])?$_GET['sort']:"d");
while ($oxz = nextOXZ($oxzs))
{
	showOXZ($oxz);
}


?>
</table>
