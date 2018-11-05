<?php
class Fiction {
	private $quotes = array();
	private $cites = array();

	public function add($quote,$cite) {
		$this->quotes[] = $quote;
		$this->cites[] = $cite;
	}

	public function printRandom() {
		$qn = rand(0,count($this->quotes)-1);
		print ('<blockquote id="setting">&ldquo;'.$this->quotes[$qn].'&rdquo; <cite>&mdash; '.$this->cites[$qn].'</cite></blockquote>');
	}
}

$f = new Fiction();

/* Add fiction entries below */

$f->add(
	"The Courier turned, its rear gun mounting tracking Coran’s Mk1 Cobra. Fierce energy fire burst out. The Mk1 Cobra was sent tumbling and exploded, pieces of hull and equipment dispersing into the darkness.",
	"from <a href='http://www.drewwagar.com/downloads/books/oolite/Status_Quo.pdf'>Status Quo</a> by Drew Wagar"
	);

$f->add(
	"Smuggling was an offence; violating docking protocols was an offence. Attacking merchant ships, blasting open their hulls to steal their cargo and sending their crews to a choking death in the blackness of space was an offence. In a system like Qudira one did not have to be an expert in Co-op law to know what kind of offender to expect.",
	"from <a href='https://www.smashwords.com/books/view/301780'>Calliope</a> by Blaze O'Glory"
	);

$f->add(
	"A tiny spark lit up on the Boa’s nose, then almost instantaneously ballooned into a glowing sphere, electric blue, alight with frantic energies: the mouth of a newly opened wormhole, swallowing the merchantman completely.",
	"from <a href='https://www.smashwords.com/books/view/301781'>Stranglehold</a> by Blaze O'Glory"
	);

$f->add(
	"Twelve jumps out from Zaquesso found him sitting in the spacer bar on Bizaar station. Not a very wholesome place … or system for that matter. Apart from a ferocious firefight in Anisat system the run so far had been fairly uneventful, but he had been expecting some hassle here. This was a gateway system … if you wanted to get from Spaceway Five to the Extrinsic Reach you had to pass through here. Most anarchy systems were dangerous but Bizaar was doubly so.",
	"from <a href='https://app.box.com/s/7ykrang6xmqausxp989e'>Coyote</a> by Cody"
	);

$f->add(
	"Hitting the injectors briefly, she sent <i>Essence of Now</i> hurtling in amongst the Vipers, looping and spinning, alternating between fore and aft lasers, scoring heavy, precise hits, while disdainfully ignoring what few hits they managed to land. It was a masterful display of combat flying – a fast and furious onslaught that caught the Viper pilots completely by surprise.",
	"from <a href='https://app.box.com/s/7ykrang6xmqausxp989e'>Inside Straight</a> by Cody"
	);

$f->add(
	"Spacer morality is different. There was a mass murder in the Southern Ocean Corporation a few years back. You probably remember the news. Ninety-five dead, over four hundred wounded. The most serious single incident for twenty years. My combat rating is less than a stone's throw from Deadly. I don't know exactly how many people I've killed, but it's probably about fifty times as many.",
	"from <a href='http://aegidian.org/bb/viewtopic.php?f=11&t=14101'>Extracts from the Tre Clan Addresses on Interplanetary Life</a> by cim"
	);


$f->add("Xevera is in close proximity to a number of pretty lawless systems, and so makes a decent base for my lifestyle. I like to keep my nose clean and my lasers hot, and I'm sure the cops in those Anarchies have grown to recognize my paintwork. But sometimes one needs a little variety, that isn't always, strictly speaking, completely legal.",
		"from <a href='http://aegidian.org/bb/viewtopic.php?f=2&t=8667&start=825#p206597'>Tales from the Spacelanes</a> by Mad Dan Eccles"
	);

$f->add("On arrival at Edbeis it was mayhem all the way in. I found myself shadowing a couple of lone traders, so I helped fend off the local predators. But then the Thargoids showed up, and briefly everyone actually pulled together. It didn't last of course. I headed over to investigate some laser fire, and found three pilots with clean records fighting amongst themselves. That's what the clean living guys do for fun around these parts? I left them to it.",
		"from <a href='http://aegidian.org/bb/viewtopic.php?f=2&t=8667&start=750#p202964'>Tales from the Spacelanes</a> by JD"
	);

$f->add("A ship glints in the darkness up ahead. For once I'm actually hoping I run into a pirate. Maybe then I can slip away while the cops have a bigger fish to catch. But the blip that pops up on my scanner is another purple. Reinforcements?! This just isn't fair; I'm barely staying alive as it is. I've already got my eye on a huge asteroid up ahead. If it's a Rock Hermit, I can give them the slip by ducking in there, or at least buy time to recharge my shields.",
		"from <a href='http://aegidian.org/bb/viewtopic.php?f=2&t=8667&start=720#p197636'>Tales from the Spacelanes</a> by rayner"
	);
	
$f->add("Oolite is a bottomless well of Elite style space entertainment. (95%)",
		"from <a href='https://plnehry.idnes.cz/oolite-recenze-013-/Clanek.aspx?c=A180803_222830_bw-plnehry-simul_haj'>plnehry.idnes.cz</a> (8 August 2018)"
	);
	



/* End fiction entries */

$f->printRandom();

?>
