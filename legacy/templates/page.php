<?php
require(dirname(__FILE__)."/../config.php");

function show_page($pagetitle,$pagetemplate) {
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title><?php print $pagetitle; ?></title>
	<link rel="stylesheet" type="text/css" href="<?php print OO_NAV_BASE; ?>/css/oolite.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
  <div id="body">
  <h1><?php print $pagetitle; ?></h1>
  	<div id="content">
	<?php include ("pages/".$pagetemplate); ?>
	</div>
  </div>
  <div id="navigation">
	<a href='<?php print OO_NAV_BASE; ?>/'><img src="<?php print OO_NAV_BASE; ?>/images/template/logo.png" alt="Oolite"></a>
	<?php include ("navigation.php"); ?>
	<?php include ("fiction.php"); ?>
  </div>
  <div id="footer">&copy; 2003–<?php print date("Y"); ?> Giles Williams, Jens Ayton & contributors</div>
</body>
</html>
<?php } ?>
