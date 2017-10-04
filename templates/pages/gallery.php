<div id="gallery">
<?php

$images = array(
	"Basic game" => array(
		"Main.jpg" => "Oolite's start screen includes an expansion pack manager and quick reference guides",
		"Tutorial.png" => "A tutorial introduces the basics of piloting, combat, and travel.",
		"Maraus.jpg" => "Oolite has over 2000 systems to explore. This is Maraus, a wealthy industrial world.",
		"Contracts.png" => "A route finder allows long journeys to be planned - great for transport contracts",
		"Station.png" => "Orbital stations provide facilities and protection to pilots",
		"Equipment.png" => "A wide range of equipment is available to increase your chances of survival."
		),
	"Expansion packs" => array(
		"NovaMining.jpg" => "Mining...my own business",
		"CrescentPlanet.jpg" => "Crescent Planet",
		"GriffThargoid.png" => "Thargoid warships",
		"CatII.png" => "A Cat Mark II launching a missile under heavy fire",
		"Kiota.png" => "A fight near a Kiota Manufacturing Station",
		"Dodec.png" => "The docking port of a Dodecahedron station",
		"Griffin.png" => "A Griffin light trader beginning docking approach",
		"RandomHits.png" => "Many expansion packs add extra careers - in this case, contract assassin",
		"TradePost.jpg" => "A freighter launches from a trade outpost",
		"another_commander-TheTraveller.png" => "The Traveller",
		"another-commander-oolite-1175.png" => "",
		"another-commander-oolite-1208.png" => "",
		"pleiadian20170312-oolite-012.png" => "",
		"pleiadian20170312-oolite-014.png" => "",
		"another_comander-oolite-1085.png" => "",
		"another_commander-Cobra2X_01.png" => "Cobra-II X",
		"another_commander-iguana02.png" => "",
		"another_commander-iguana04.png" => "",
		"another_commander-iguana05.png" => "",
		"another_commander-oolite-016.png" => "",
		"another_commander-oolite-1015.png" => "",
		"another_commander-oolite-1029.png" => "",
		"another_commander-oolite-1159.png" => "",
		"another_commander-oolite-1169.png" => "",
		"another_commander-oolite-1209.png" => "",
		"another_commander-20160514-Ferdie01.jpg" => "",
		"another_commander-20160609-oolite_005.jpg" => "",
		"another_commander-20160609-oolite_007.jpg" => "",
		"another_commander-20160816-kraitYo03.jpg" => "",
		"another_commander-20160816-kraitYo04.jpg" => "",
		"another_commander-20160816-kraitYo07.jpg" => "",
		"another_commander-20170627-combat19.jpg" => "",
		"another_commander-20170718-EDHUD02.jpg" => "",
		"another_commander-20170718-EDHUD04.jpg" => "",
		"another_commander-20170718-EDHUD05.jpg" => "",
		"another_commander-AnacondaDown01.jpg" => "",
		"another_commander-AnacondaDown02.jpg" => "",
		"another_commander-AnacondaDown03.jpg" => "",
		"another_commander-AnacondaDown04.jpg" => "",
		"another_commander-Boa_Chase00.jpg" => "",
		"another_commander-Boa_Chase01.jpg" => "",
		"another_commander-Boa_Chase02.jpg" => "",
		"another_commander-Boa_Chase03.jpg" => "",
		"another_commander-earth_Like01.jpg" => "Earth-like system",
		"another_commander-stationApproach.jpg" => "Station Approach",
		"cody20160213-Ceerti.png" => "Ceerti system",
		"cody20160217-Xeonar.png" => "Xeonar system",
		"cody20160415-Outbound.png" => "",
		"cody20170319-Gebeti.png" => "Gebeti system",
		"cody20170626-Rings-1.png" => "",
		"cody20170819-Ceraxete.png" => "Ceraxete system",
		"cody20170924-Ribior.png" => "Ribior system",
		"devium20151110-interstellar.png" => "Interstellar jump hijack",
		"gsagostinho20160128-oolite.png" => "",
		"gsagostinho20170705-shot.png" => "",
		"gsagostinho20170711b-image.png" => "",
		"gsagostinho20170711-image.png" => "",
		"gsagostinho20170806-oolite-002.jpg" => "",
		"norby20160517-StarDestroyerHoover.png" => "Star Destroyer Hoover",
		"norby20161125-consg.png" => "",
		"pagroove20160521-Cat3.png" => "",
		"pagroove-ooplanet.png" => "",
		"phkb20160518-approaching_dock.png" => "",
		"phkb20161014-oolite-077.png" => "",
		"phkb20161014-oolite-078.png" => "",
		"phkb20161014-oolite-080.png" => "",
		"phkb20161014-oolite-087.png" => "",
		"phkb20161024-oolite-102.png" => "",
		"phkb20161130-oolite-129.png" => "",
		"phkb20161130-oolite-130.png" => "",
		"pleiadian20170401-forumimage.png" => "",
		"pleiadian20170408b-forumimage.png" => "",
		"pleiadian20170408-forumimage.png" => "",
		"another_commander-20160421-combat14.jpg" => "",
		"another_commander-20160421-combat15.jpg" => "",
		"another_commander-20160421-combat16.jpg" => ""
		)
	);

$meta = array(
	"NovaMining.jpg" => "Screenshot by another_commander with Zygo Cinematic Skies, Griff Ships, Zygo Explosions and other OXPs",
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

