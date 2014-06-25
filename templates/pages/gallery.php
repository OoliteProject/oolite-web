<div id="gallery">
<?php

$images = array(
	"Basic game" => array(
		"Main.jpg" => "Oolite 1.80's start screen includes an expansion pack manager and quick reference guides",
		"Tutorial.png" => "A tutorial introduces the basics of piloting, combat, and travel.",
		"Maraus.jpg" => "Oolite has over 2000 systems to explore. This is Maraus, a wealthy industrial world.",
		"Contracts.png" => "A route finder allows long journeys to be planned - great for transport contracts",
		"Station.png" => "Orbital stations provide facilities and protection to pilots",
		"Equipment.png" => "A wide range of equipment is available to increase your chances of survival."
		),
	"Expansion packs" => array(
		"CrescentPlanet.jpg" => "Crescent Planet",
		"GriffThargoid.png" => "Thargoid warships",
		"CatII.png" => "A Cat Mark II launching a missile under heavy fire",
		"Kiota.png" => "A fight near a Kiota Manufacturing Station",
		"Dodec.png" => "The docking port of a Dodecahedron station",
		"Griffin.png" => "A Griffin light trader beginning docking approach",
		"RandomHits.png" => "Many expansion packs add extra careers - in this case, contract assassin",
		"TradePost.jpg" => "A freighter launches from a trade outpost"
		)
	);

$meta = array(
	"CrescentPlanet.jpg" => "Screenshot by Cody with CinematicSky&Nebulas, Farsun, and Povray Planets OXPs", // http://s1355.photobucket.com/user/Commander-Cody/media/Oolite/Crescent-2_zpsaf930f29.png.html
	"Maraus.jpg" => "Screenshot by Cody",
	"GriffThargoid.png" => "Screenshot with CinematicSky&Nebulas and Griff's Ship set",
	"CatII.png" => "Cat Mark II from Random Hits",
	"Kiota.png" => "Wildships and Griff's Ship set",
	"RandomHits.png" => "Random Hits expansion pack",
	"TradePost.jpg" => "Your Ad Here! and Griff Boa"
	);

function image_randomiser($a,$b)
{
	return 2*(rand(1,2)-1.5);
}

foreach ($images as $header => $imageset) 
{
	if (count($imageset) > 9)
	{
		uksort($imageset,"image_randomiser");
		$imageset = array_slice($imageset,0,9);
	}
	else if ($header != "Basic game")
	{
		uksort($imageset,"image_randomiser");
	}
	
	print ("<h2 class='galleryhead'>$header</h2>\n");
	print ("<div class='galleryblock'>");
	$set = 0;
	foreach ($imageset as $image => $caption) 
	{
		$set++;
		print ("<div class='galleryitem'>");
		print ("<a href='".OO_NAV_BASE."/images/gallery/large/$image'><img src='".OO_NAV_BASE."/images/gallery/small/$image' alt=''");
		if (isset($meta[$image]))
		{
			print(" title=\"".htmlspecialchars($meta[$image])."\"");
		}
		print ("><span>".$caption."</span></a>");
		print ("</div>");
		if ($set % 3 == 0)
		{
			print ("<br class='gallerysep'>");
		}
	}
	print ("</div>");
}

?>
</div>

