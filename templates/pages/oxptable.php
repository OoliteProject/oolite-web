<?php
if($_GET['desc']>0) {
  $desc="&desc=1";
  $invdesc = 0;
  $invdescshow = "Hide";
} else {
  $desc="";
  $invdesc = 1;
  $invdescshow = "Show";
}
?>
<p style="color: #aaa; margin: 0; margin-top: 0em; padding: 0em; font-size: 90%;">Click column header to sort table.
<a href='./?sort=<?php echo sort_parameter();?>&desc=<?php echo $invdesc;?>'><?php echo $invdescshow;?> descriptions.</a></p>
<table class='oxzs'>
<tr><th><a href='./?sort=c<?php
echo $desc?>'>Category</a></th><th><a href='./?sort=t<?php
echo $desc?>'>Title</a></th><th><a href='./?sort=a<?php
echo $desc?>'>Author</a></th><th><a href='./?sort=d<?php
echo $desc?>'>Updated</a></th><th title='Download'>↓</th></tr>

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
	if($_GET['desc']>0) print ("<tr><td colspan='5'>".htmlspecialchars($oxz['description'])."</td></tr>");
}

function nextOXZ($query) {
	return $query->fetch();
}

function sort_parameter() {
    return(isset($_GET['sort'])?$_GET['sort']:"d");
}
	
$oxzs = getOXZs(sort_parameter());
while ($oxz = nextOXZ($oxzs))
{
	showOXZ($oxz);
}


?>
</table>
