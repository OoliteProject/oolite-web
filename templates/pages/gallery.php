<style>
/* Position the image container (needed to position the left and right arrows) */
.container {
  position: relative;
  margin: 0.2em;
  width: 100%;
  border: thin #888 solid;
}

.container img {
  vertical-align: middle;
}

/* Hide the images by default */
.mySlides, oxp_mySlides {
  display: none;  
}

/* Add a pointer when hovering over the thumbnail images */
.cursor {
  cursor: pointer;
}

/* Next & previous buttons */
.prev, .oxp_prev, .thumb_prev, 
.next, .oxp_next, .thumb_next {
  cursor: pointer;
  position: absolute;
  top: 60%;
  width: auto;
  padding: 16px;
  margin-top: -50px;
  background-color: rgba(4, 4, 28, 0.8);
  color: white;
  font-weight: bold;
  font-size: 20px;
  border-radius: 0 3px 3px 0;
  user-select: none;
  -webkit-user-select: none;
}

.thumb_prev, 
.thumb_next {
  position: absolute;
  top: 0%;
  margin: 2px 4px 2px 2px;
  padding: 8px 3px;
}

/* Position the "next button" to the right */
.next, .oxp_next, .thumb_next {
  right: 0;
  border-radius: 3px 0 0 3px;
}

/* On hover, add a black background color with a little bit see-through */
.prev:hover, .oxp_prev:hover, .thumb_prev:hover, 
.next:hover, .oxp_next:hover, .thumb_next:hover {
  background-color: rgba(12, 12, 85, 0.8);
}

/* Container for image text */
.caption-container, .oxp_caption-container {
  background-color: #222;
  padding: 2px 16px;
  color: white;
}

.oxp_caption-container {
  text-align: center;
}

.row:after {
  content: "";
  display: table;
  clear: both;
  align: center;
  margin: auto;
}

/* Six columns side by side */
.column {
  float: left;
  width: 16.6%;
  padding: 0px;
}

.thumb_column {
  float: left;
  width: auto;
  padding: 8px 2px;
}

/* Add a transparency effect for thumnbail images */
.demo, .oxp_demo {
  opacity: 0.5;
  border: thin #000 solid;
}

.active,
.demo:hover, oxp_demo:hover {
	opacity: 1;
	border: thin #888 solid;
}

button {
	font:inherit;
	margin:0;
	overflow:visible;
	text-transform:none;
}

.gallery-button {
	border:none;
	padding:8px 16px;
	vertical-align:middle;
	overflow:hidden;
	text-decoration:none;
	color:inherit;
	text-align:center;
	cursor:pointer;
	-webkit-touch-callout:none;
	-webkit-user-select:none;
	-khtml-user-select:none;
	-moz-user-select:none;
	-ms-user-select:none;
	user-select:none
	white-space:normal;
	border:thin #009 solid;
	border-radius: 6px;
	background: #000618;
	margin: 0.2em;
}

.gallery-bar {
	width: 100%;
	overflow: hidden;
	display: inline-block;
}

.gallery-bar-item {
	padding:4px 8px;
	float:left;
	width:auto;
	outline:0;
}


.selected {
	color:white;
	border:thin #009 solid;
	background: #0c0c55;
	cursor: default;
}

.gallery-button:hover {
  background:#118;
}
</style>

<div id="gallery">
	<div class="gallery-bar">
		<button class="gallery-bar-item gallery-button  selected" onclick="openTab('basic_container')">Basic Game</button>
		<button class="gallery-bar-item gallery-button" onclick="openTab('oxp_container')">Expansion Packs</button>
	</div>
	<div id="basic_container" class="container">
		<div class="row">
			<div class="column">
				<img class="demo cursor" src="/images/gallery/small/Main.png" style="width:100%" onclick="currentSlide(1)" alt="Oolite's start screen includes an expansion pack manager and quick reference guides.">
			</div>
			<div class="column">
				<img class="demo cursor" src="/images/gallery/small/Tutorial.png" style="width:100%" onclick="currentSlide(2)" alt="A tutorial introduces the basics of piloting, combat, and travel.">
			</div>
			<div class="column">
				<img class="demo cursor" src="/images/gallery/small/Maraus.png" style="width:100%" onclick="currentSlide(3)" alt="Oolite has over 2000 systems to explore. This is Maraus, a wealthy industrial world.">
			</div>
			<div class="column">
				<img class="demo cursor" src="/images/gallery/small/Contracts.png" style="width:100%" onclick="currentSlide(4)" alt="A route finder allows long journeys to be planned - great for transport contracts.">
			</div>
			<div class="column">
				<img class="demo cursor" src="/images/gallery/small/Station.png" style="width:100%" onclick="currentSlide(5)" alt="Orbital stations provide facilities and protection to pilots.">
			</div>    
			<div class="column">
				<img class="demo cursor" src="/images/gallery/small/Equipment.png" style="width:100%" onclick="currentSlide(6)" alt="A wide range of equipment is available to increase your chances of survival.">
			</div>
		</div>

		<div class="caption-container">
			<p id="caption"></p>
		</div>

		<div class="mySlides">
			<a href="/images/gallery/large/Main.png" target="_blank"><img src="/images/gallery/preview/Main.png" style="width:100%"></a>
		</div>

		<div class="mySlides">
			<a href="/images/gallery/large/Tutorial.png" target="_blank"><img src="/images/gallery/preview/Tutorial.png" style="width:100%"></a>
		</div>

		<div class="mySlides">
			<a href="/images/gallery/large/Maraus.png" target="_blank"><img src="/images/gallery/preview/Maraus.png" style="width:100%"></a>
		</div>

		<div class="mySlides">
			<a href="/images/gallery/large/Contracts.png" target="_blank"><img src="/images/gallery/preview/Contracts.png" style="width:100%"></a>
		</div>

		<div class="mySlides">
			<a href="/images/gallery/large/Station.png" target="_blank"><img src="/images/gallery/preview/Station.png" style="width:100%"></a>
		</div>

		<div class="mySlides">
			<a href="/images/gallery/large/Equipment.png" target="_blank"><img src="/images/gallery/preview/Equipment.png" style="width:100%"></a>
		</div>

		<a class="prev" onclick="plusSlides(-1)">&#10094;</a>
		<a class="next" onclick="plusSlides(1)">&#10095;</a>
	</div>

	<div id="oxp_container" class="container" style="display: none">
<?php
$images = array(
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
		"another-commander-oolite-1175.png" => "Near-collision experience",
		"another-commander-oolite-1208.png" => "Skimming those flames",
		"pleiadian20170312-oolite-012.png" => "Camo-coated my ride",
		"pleiadian20170312-oolite-014.png" => "Leaving the Torus",
		"another_comander-oolite-1085.png" => "Pinched my... aft",
		"another_commander-Cobra2X_01.png" => "Cobra-II X",
		"another_commander-iguana02.png" => "Long distance call",
		"another_commander-iguana04.png" => "Evading arrest",
		"another_commander-iguana05.png" => "Spread'em!",
		"another_commander-oolite-016.png" => "Travel in an orbit",
		"another_commander-oolite-1015.png" => "The Kiota Research Station",
		"another_commander-oolite-1029.png" => "Thargoid lurking in interstellar space",
		"another_commander-oolite-1159.png" => "Ice and dust highway",
		"another_commander-oolite-1169.png" => "Space sobrero",
		"another_commander-oolite-1209.png" => "Heroes emerge from flames",
		"another_commander-20160514-Ferdie01.jpg" => "Sunshine... not the movie",
		"another_commander-20160609-oolite_005.jpg" => "Jester's Dead, Yee-haw!",
		"another_commander-20160609-oolite_007.jpg" => "Spot-on, Commander!",
		"another_commander-20160816-kraitYo03.jpg" => "How to miss a sitting duck",
		"another_commander-20160816-kraitYo04.jpg" => "Krait in trouble",
		"another_commander-20160816-kraitYo07.jpg" => "Engaging near a GalCop station",
		"another_commander-20170627-combat19.jpg" => "Any...blast words?",
		"another_commander-20170718-EDHUD02.jpg" => "Grasp the rooster tail",
		"another_commander-20170718-EDHUD04.jpg" => "Bullseye",
		"another_commander-20170718-EDHUD05.jpg" => "Aft view monitor screen effect",
		"another_commander-20171108-kiota4SolarWith2Cobra.png" => "Hiding in the shadows",
		"another_commander-20171109-dogfightAsteroidField.png" => "Dogfight in the asteroid belt",
		"another_commander-20171201-oolite-004.png" => "Watch out for 'em rocks!",
		"another_commander-20171201-oolite-005.png" => "Hide 'n seek",
		"another_commander-20171201-oolite-010.png" => "Going Off Road!",
		"another_commander-20171201-oolite-014.png" => "Steady... Rock steady!",
		"another_commander-20171201-oolite-020.png" => "Asteroid storm",
		"another_commander-AnacondaDown03.jpg" => "Anaconda down... time for looting!",
		"another_commander-20171201-oolite-023.png" => "Rock am Ring festival",
		"another_commander-20171201-oolite-026.png" => "Hitchhiker's Guide to... Off-Roading",
		"another_commander-210210_LeavingCoriolisAgain.png" => "Leaving Coriolis...again!",
		"another_commander-AnacondaDown01.jpg" => "Spoils of war",
		"another_commander-AnacondaDown02.jpg" => "Just blown an anaconda",
		"another_commander-AnacondaDown04.jpg" => "Loot... in space",
		"another_commander-Boa_Chase00.jpg" => "Boa's escort alerted",
		"another_commander-Boa_Chase01.jpg" => "Messing with a Boa",
		"another_commander-Boa_Chase02.jpg" => "Boa in distress",
		"another_commander-Boa_Chase03.jpg" => "Defending a Boa",
		"another_commander-earth_Like01.jpg" => "Earth-like system",
		"another_commander-stationApproach.jpg" => "Station Approach",
		"cody20160213-Ceerti.png" => "Ceerti - a revolting little planet",
		"cody20160217-Xeonar.png" => "Xeonar - scourged by evil disease",
		"cody20160415-Outbound.png" => "A journey begins",
		"cody20170319-Gebeti.png" => "Gebeti - fabled for its ancient Et banana plantations",
		"cody20170626-Rings-1.png" => "Confined in rings",
		"cody20170819-Ceraxete.png" => "Ceraxete - inhabited by fierce harmless slimy frogs",
		"cody20170924-Ribior.png" => "Ribior - noted for its mountain slugs",
		"devium20151110-interstellar.png" => "Interstellar jump hijack",
		"gsagostinho20160128-oolite.png" => "",
		"gsagostinho20170705-shot.png" => "Quedle system is cursed by killer edible talking treeoids",
		"gsagostinho20170711b-image.png" => "Coming home",
		"gsagostinho20170711-image.png" => "Planet with cityscape",
		"gsagostinho20170806-oolite-002.jpg" => "4x \"witch\"drive towards the eclipse",
		"gsagostinho20171106-oolite-007.png" => "The \"eclipsing\" Cobra Mk. IV",
		"norby20160517-StarDestroyerHoover.png" => "Star Destroyer Hoover",
		"norby20161125-consg.png" => "Constrictor caught on camera",
		"pagroove20160521-Cat3.png" => "Love'em marbles",
		"pagroove-ooplanet.png" => "Paint'em with magenta star light",
		"phkb20160518-approaching_dock.png" => "Abandoned Torus station approach",
		"phkb20161014-oolite-077.png" => "Waxing crescent",
		"phkb20161014-oolite-078.png" => "Gas giant flyby",
		"phkb20161014-oolite-080.png" => "The Cobra Mk. I",
		"phkb20161014-oolite-087.png" => "Waxing crescent",
		"phkb20161024-oolite-102.png" => "Saturated",
		"phkb20161130-oolite-129.png" => "From dusk till dawn",
		"phkb20161130-oolite-130.png" => "Big brother is watching",
		"pleiadian20170401-forumimage.png" => "Mandelbrot was here",
		"pleiadian20170408b-forumimage.png" => "The Lord of the Rings",
		"pleiadian20170408-forumimage.png" => "Match that station's rotation!",
		"another_commander-20160421-combat14.jpg" => "Hostile work environment",
		"another_commander-20160421-combat15.jpg" => "Red alert",
		"another_commander-20160421-combat16.jpg" => "Law enforcement crossfire",
		"another_commander-200726_MeteorStorm01.png" => "Meteor shower hitting Earth",
		"another_commander-200726_MeteorStorm04.png" => "Coriolis to the rescue",
		"another_commander-200726_oolite-069.png" => "The land of revolutions",
		"another_commander-200726_oolite-113.png" => "Coriolis over Europe",
		"another_commander-200726_oolite-173.png" => "Magenta is OK; loose the bullseye, though",
		"another_commander-200726_oolite-178.png" => "A bullseye? Really?!?",
		"another_commander-200726_oolite-182.png" => "Red Boa hovering Earth",
		"another_commander-200726_oolite-190.png" => "Blue Boa is fine; Loose that bullseye!",
		"another_commander-200726_oolite-202.png" => "Royal Blue Iguana",
		"another_commander-200726_oolite-212.png" => "Red Iguana",
		"another_commander-200726_oolite-215.png" => "To infinity... and beyond",
		"another_commander-200726_oolite-218.png" => "Moon, here I come!",
		"another_commander-200726_oolite-229.png" => "Earth flyby",
		"another_commander-200726_oolite-233.png" => "See you on the dark side of the moon",
		"another_commander-200726_oolite-234.png" => "A long kiss goodnight",
		"another_commander-200726_oolite-249.png" => "Blast that dark chitin-covered insect",
		"another_commander-200726_oolite-252.png" => "Clear the area; no Thargoids allowed here",
		"another_commander-200726_oolite-256.png" => "That hurt",
		"another_commander-200726_oolite-259.png" => "Zap'em Thargoids!",
		"another_commander-200726_oolite-262.png" => "Missile launched!",
		"another_commander-200726_oolite-268.png" => "Did you just blow my Coriolis?!?",
		"another_commander-200726_oolite-274.png" => "It's a brave new world",
		"another_commander-200726_oolite-288.png" => "Let me in, let me in",
		"another_commander-200726_oolite-291.png" => "Home, sweet home",
		"another_commander-200726_oolite-294.png" => "Coriolis sunrise",
		"another_commander-200726_oolite-296.png" => "Adventure awaits, go find it",
		"another_commander-200726_oolite-299.png" => "Meteoroj",
		"another_commander-200726_oolite-305.png" => "Waiting for docking clearance",
		"another_commander-200726_oolite-310.png" => "Manic Miner",
		"another_commander-200726_oolite-317.png" => "Earth's sibling",
		"another_commander-200726_oolite-330.png" => "My God, It's Full of Stars",
		"another_commander-200726_oolite-402.png" => "Leaving the blue planet",
		"another_commander-200726_oolite-409.png" => "Also Sprach Zarathustra"
	);

function image_randomiser($a,$b)
{
	return 2*(rand(1,2)-1.5);
}

uksort($images, "image_randomiser");
$images_slice = array_slice($images,0,6);

print ("<div class=\"row\">\n");
$imgcnt = 0;
foreach ($images_slice as $image => $caption)
{
	$imgcnt++;
	print ("<div class=\"column\">\n");
	print ("<img class=\"oxp_demo cursor\" src=\"/images/gallery/small/$image\" style=\"width:100%\" onclick=\"oxp_currentSlide($imgcnt)\" alt=\"$caption\">\n");
	print ("</div>\n");
}
print ("</div>\n\n");

print ("<div class=\"oxp_caption-container\">\n");
print ("<p id=\"oxp_caption\"></p>\n");
print ("</div>\n\n");

$imgcnt = 0;
foreach ($images_slice as $image => $caption)
{
	$imgcnt++;
	print("<div class=\"oxp_mySlides\">\n");
	print ("<a id=\"a_obj_$imgcnt\" href=\"/images/gallery/large/$image\" target=\"_blank\"><img id=\"img_obj_$imgcnt\" src=\"/images/gallery/preview/$image\" style=\"width:100%\"></a>\n");
	print ("</div>\n");
}
print ("\n");

print ("<a class=\"thumb_prev\" onclick=\"oxp_plusSet(-1)\">&#10094;</a>\n");
print ("<a class=\"thumb_next\" onclick=\"oxp_plusSet(1)\">&#10095;</a>\n");
print ("<a class=\"oxp_prev\" onclick=\"oxp_plusSlides(-1)\">&#10094;</a>\n");
print ("<a class=\"oxp_next\" onclick=\"oxp_plusSlides(1)\">&#10095;</a>\n");
print ("\n");
?>
	</div>
	
	<script language="JavaScript">
		const oxp_thumbsCount = 6;
		var json_images = <?php echo json_encode($images) ?>;
		var images = [];
		var slideIndex = 1;
		var oxp_slideIndex = 1;
		var oxp_setIndex = 1;
		
		showSlides(slideIndex);
		oxp_showSlides(oxp_slideIndex);

		for(var i in json_images)
			images.push([i, json_images [i]]);
		const oxp_lastSetIndex = (images.length - images.length % oxp_thumbsCount) - (oxp_thumbsCount-1);
		
		function plusSlides(n) {
			showSlides(slideIndex += n);
		}

		function currentSlide(n) {
			showSlides(slideIndex = n);
		}

		function showSlides(n) {
			var i;
			var slides = document.getElementsByClassName("mySlides");
			var dots = document.getElementsByClassName("demo");
			var captionText = document.getElementById("caption");
			if (n > slides.length) {slideIndex = 1}
			if (n < 1) {slideIndex = slides.length}
			for (i = 0; i < slides.length; i++) {
				slides[i].style.display = "none";
			}
			for (i = 0; i < dots.length; i++) {
				dots[i].className = dots[i].className.replace(" active", "");
			}
			slides[slideIndex-1].style.display = "block";
			dots[slideIndex-1].className += " active";
			captionText.innerHTML = dots[slideIndex-1].alt;
		}
		
		function oxp_plusSlides(n) {
			oxp_showSlides(oxp_slideIndex += n);
		}

		function oxp_currentSlide(n) {
			oxp_showSlides(oxp_slideIndex = n);
		}

		function oxp_showSlides(n) {
			var i;
			var slides = document.getElementsByClassName("oxp_mySlides");
			var dots = document.getElementsByClassName("oxp_demo");
			var captionText = document.getElementById("oxp_caption");
			if (n > slides.length) {oxp_slideIndex = 1}
			if (n < 1) {oxp_slideIndex = slides.length}
			for (i = 0; i < slides.length; i++) {
				slides[i].style.display = "none";
			}
			for (i = 0; i < dots.length; i++) {
				dots[i].className = dots[i].className.replace(" active", "");
			}
			slides[oxp_slideIndex-1].style.display = "block";
			dots[oxp_slideIndex-1].className += " active";
			captionText.innerHTML = dots[oxp_slideIndex-1].alt;
		}
		
		function oxp_plusSet(n) {
			const oxp_setStep = oxp_thumbsCount * n;
			const oxp_currentSetIndex = oxp_setIndex;
			
			oxp_setIndex += oxp_setStep;
			if (oxp_setIndex < 1) {
				oxp_setIndex = oxp_lastSetIndex; 
			} else if (oxp_setIndex > oxp_lastSetIndex) {
				oxp_setIndex = 1;
			}
			
			oxp_showSet(oxp_setIndex);
		}
		
		function oxp_showSet(n) {
			var i;
			var dots = document.getElementsByClassName("oxp_demo");
			
			for (i = 0; i < oxp_thumbsCount; i++) {
				dots[i].src = "/images/gallery/small/" + images[oxp_setIndex-1+i][0];
				dots[i].alt = images[oxp_setIndex-1+i][1];
				dots[i].className = dots[i].className.replace(" active", "");
				
				img_obj = document.getElementById("img_obj_"+(i+1));
				img_obj.src = "/images/gallery/preview/" + images[oxp_setIndex-1+i][0];

				a_obj = document.getElementById("a_obj_"+(i+1));
				a_obj.href = "/images/gallery/large/" + images[oxp_setIndex-1+i][0];
			}
			
			oxp_currentSlide(oxp_setIndex);
		}
		
		function openTab(tabdivID) {
			var i;
			var x = document.getElementsByClassName("container");
			var items = document.getElementsByClassName("gallery-button");

			for (i = 0; i < items.length; i++) {
				items[i].className = items[i].className.replace(" selected", "");
			}
			items[(tabdivID == "basic_container" ? 0 : 1)].className += " selected";

			for (i = 0; i < x.length; i++) {
				x[i].style.display = "none";  
			}
			document.getElementById(tabdivID).style.display = "";  
		}
	</script>
</div>

