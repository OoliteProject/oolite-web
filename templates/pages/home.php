<?php include("news.html"); ?>
<?php include("oxpnews.php"); ?>

		<style>
			.mySlides {display: none}
			
			/* Slideshow container */
			.slideshow-container {
				max-width: 1000px;
				position: relative;
				margin: auto;
			}
			
			/* Next & previous buttons */
			.prev, .next {
				cursor: pointer;
				position: absolute;
				top: 50%;
				width: auto;
				padding: 16px;
				margin-top: -22px;
				color: white;
				font-weight: bold;
				font-size: 18px;
				transition: 0.6s ease;
				border-radius: 0 3px 3px 0;
				user-select: none;
			}
			
			/* Position the "next button" to the right */
			.next {
				right: 0;
				border-radius: 3px 0 0 3px;
			}
			
			/* On hover, add a black background color with a little bit see-through */
			.prev:hover, .next:hover {
				background-color: rgba(12,12,85,0.8);
			}
			
			/* Fading animation */
			.fade {
				-webkit-animation-name: fade;
				-webkit-animation-duration: 1.5s;
				animation-name: fade;
				animation-duration: 1.5s;
			}
			
			@-webkit-keyframes fade {
				from {opacity: .4} 
				to {opacity: 1}
			}
			
			@keyframes fade {
				from {opacity: .4} 
				to {opacity: 1}
			}
			
			/* On smaller screens, decrease text size */
			@media only screen and (max-width: 300px) {
				.prev, .next {font-size: 11px}
			}
		</style>
	  <div id="maincontent">

		<div id="introbanner" class="slideshow-container">
			<div class="mySlides fade">
				<img id="slide0" src="" style="width:100%">
			</div>

			<div class="mySlides fade">
				<img id="slide1" src="" style="width:100%">
			</div>

			<div class="mySlides fade">
				<img id="slide2" src="" style="width:100%">
			</div>

			<div class="mySlides fade">
				<img id="slide3" src="" style="width:100%">
			</div>

			<div class="mySlides fade">
				<img id="slide4" src="" style="width:100%">
			</div>

			<div class="mySlides fade">
				<img id="slide5" src="" style="width:100%">
			</div>

			<div class="mySlides fade">
				<img id="slide6" src="" style="width:100%">
			</div>

			<div class="mySlides fade">
				<img id="slide7" src="" style="width:100%">
			</div>

			<div class="mySlides fade">
				<img id="slide8" src="" style="width:100%">
			</div>

			<a id="prev" class="prev" onClick="">&#10094;</a>
			<a id="next" class="next" onClick="">&#10095;</a>
		</div>
		
		<p>Among the seven trillion people who are - at least officially - Cooperative citizens, you are nobody. So far, anyway. You've got a ship, some weapons, and enough spare cash to get started - and one day, you might get the fame, wealth or glory you want. Perhaps one day, everyone might know your name. If, that is, you can survive that long.</p>

		<p>The two thousand star systems of the Cooperative once enjoyed a golden age of peace and prosperity, and perhaps the wealthiest of them can still pretend to. The trade ships that once safely travelled between planets now have to be well armed and escorted to fend off pirate attacks, from small-time criminals desperate for their next meal, to powerful robber barons extracting tithes from everyone who passes through their space.</p>

		<p>The Cooperative's police force, concentrated near a few influential planets, can no longer maintain order. The mercenaries they hire for a few credits a kill are too few, too unreliable to do so either. And in the darkness between the stars, an old enemy lurks, fearless, perhaps waiting for order to collapse entirely.</p>

		<p>Good luck, Commander.</p>

		<div class="imgbar imgbar-chart1"></div>

		<p>Oolite is inspired by the 8-bit classic Elite, and many aspects of gameplay will be familiar to players of that game. In the tradition of open-world games, there's no overall story: you can be a millionaire trader, a veteran combateer, a feared pirate, a lonely miner, a notorious smuggler, or all of them, or something else entirely, based on your own actions.</p>

		<p>For those new to the game, the <a href='/starting'>getting started</a> page has some hints for beginners to see you safely through your first flight, and suggests ways to continue in future.</p>

		<div style="text-align: center; ">
			<img src='/images/expansions.png' style="max-width: 100%; height: auto" alt='Over five hundred expansion packs.' />
		</div>

		<p>One of the most important aspects of Oolite is customisation: almost all parts of the game can be modified using simple free text and graphics tools, and over five hundred <a href='/oxps/'>expansion packs</a> are available, ranging from minor tweaks such as a new ship or replacement sound effects, all the way up to giant missions it could take you weeks to play through.</p>

		<p>Oolite runs on Mac OS X (10.6 or later), Windows (Vista Service Pack 2 or later), and Linux. It is designed not to need the latest hardware, and requires only a 1GHz processor, 1GB of RAM, and an Open GL-capable graphics card for basic performance (though a higher specification is recommended, and some expansion packs may require a more modern computer).</p>

		<p>The game and source code are freely available under the <a href="http://www.gnu.org/licenses/gpl-2.0.html">GNU General Public License</a>.</p>

		<script language="JavaScript">
			const ooSlides = document.getElementsByClassName("mySlides");
			const maxIndex = 9;
			var intervalID = null;

<?php
	$slideset = array("another_commander-200726_oolite-069.jpg", 
"another_commander-200726_oolite-173.jpg", 
"another_commander-200726_oolite-212.jpg", 
"another_commander-200726_oolite-218.jpg", 
"another_commander-200726_oolite-229.jpg", 
"another_commander-200726_oolite-233.jpg", 
"another_commander-200726_oolite-234.jpg", 
"another_commander-200726_oolite-249.jpg", 
"another_commander-200726_oolite-268.jpg", 
"another_commander-200726_oolite-274.jpg", 
"another_commander-200726_oolite-291.jpg", 
"another_commander-200726_oolite-299.jpg", 
"another_commander-200726_oolite-310.jpg", 
"another_commander-200726_oolite-317.jpg", 
"another_commander-200726_oolite-402.jpg", 
"another_commander-200726_oolite-409.jpg", 
"another_commander-20160514-Ferdie01.jpg", 
"another_commander-20160609-oolite_005.jpg", 
"another_commander-20160816-kraitYo03.jpg", 
"another_commander-20160816-kraitYo07.jpg", 
"another_commander-20170627-combat19.jpg", 
"another_commander-20170718-EDHUD04.jpg", 
"another_commander-20171108-kiota4SolarWith2Cobra.jpg", 
"another_commander-20171201-oolite-010.jpg", 
"another_commander-20171201-oolite-026.jpg", 
"another_commander-Cobra2X_01.jpg", 
"another_commander-iguana02.jpg", 
"another_commander-iguana05.jpg", 
"another_commander-oolite-016.jpg", 
"another_commander-stationApproach.jpg", 
"another_commander-TheTraveller.jpg", 
"another-commander-oolite-1175.jpg", 
"cody20160415-Outbound.jpg", 
"devium20151110-interstellar.jpg", 
"Griffin.jpg", 
"gsagostinho20160128-oolite.jpg", 
"gsagostinho20170711-image.jpg", 
"gsagostinho20170806-oolite-002.jpg", 
"gsagostinho20171106-oolite-007.jpg", 
"norby20161125-consg.jpg", 
"NovaMining.jpg", 
"phkb20160518-approaching_dock.jpg", 
"phkb20161014-oolite-077.jpg", 
"phkb20161014-oolite-078.jpg", 
"phkb20161014-oolite-087.jpg", 
"phkb20161024-oolite-102.jpg", 
"phkb20161130-oolite-129.jpg", 
"pleiadian20170312-oolite-012.jpg", 
"pleiadian20170312-oolite-014.jpg", 
"pleiadian20170408-forumimage.jpg", 
"Station.jpg", 
"another_commander-200726_MeteorStorm04.jpg");

	function slideset_randomiser($a,$b)
	{
		return 2*(rand(1,2)-1.5);
	}

	uksort($slideset,"slideset_randomiser");

	$firstslide = reset($slideset);
	print ("const slideshowImages = [");
	print ("\"/images/homebanner/$firstslide");

	$slideset = array_slice($slideset,1,8);
	foreach ($slideset as $image)
	{
		print ("\", \n");
		print ("\"/images/homebanner/$image");
	}
	print ("\"]; \n");
?>

			// slideshow images preload
			var sldObject;
			for(var i=0; i<maxIndex; i++)
			{
				sldObject = document.getElementById("slide" + i)
				sldObject.src = slideshowImages[i];
			}

			// slideshow setup
			const nextImageDelay = 10000;
			var currentImageCounter = 0; // setting a variable to keep track of the current image (slide)


			function showNextSlide(n) {
				
				ooSlides[currentImageCounter].style.display = "none";  
				currentImageCounter += n;
				if (currentImageCounter == maxIndex) {currentImageCounter = 0}    
				if (currentImageCounter < 0) {currentImageCounter = maxIndex-1}
				ooSlides[currentImageCounter].style.display = "block";  
			}

			intervalID = setInterval(showNextSlide, nextImageDelay, 1);
			showNextSlide(1);

			document.getElementById("prev").onclick = function() {clearInterval(intervalID); showNextSlide(-1); intervalID = setInterval(showNextSlide, nextImageDelay, 1)};
			document.getElementById("next").onclick = function() {clearInterval(intervalID); showNextSlide(1); intervalID = setInterval(showNextSlide, nextImageDelay, 1)};

		</script>
	  </div>
