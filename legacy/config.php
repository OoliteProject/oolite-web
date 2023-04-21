<?php

require("local-config.php");
require("utils.php");

// default version for new OXZ manifests (should probably be latest
// stable release)
define("OOLITE_DEFAULT_OXZ_OOLITE_VERSION","1.88");

function oolite_versions() {
	return array("1.79","1.80","1.81","1.82","1.83","1.84","1.85","1.86","1.87","1.88","1.89","1.90");
}

function oolite_max_versions() {
	// assume that more than 99 point releases of a named release are unlikely
	$array = array_merge(oolite_versions(),array("1.79.99","1.80.99","1.81.99","1.82.99","1.83.99","1.84.99","1.85.99","1.86.99","1.87.99","1.88.99","1.89.99","1.90.99"));
	sort($array);
	array_unshift($array,""); // default blank
	return $array;
}

function oolite_oxp_categories() {
	$dbh = DB::dbh();
	$categories = $dbh->prepare("SELECT category_id,cat_name FROM Categories ORDER BY cat_name");
	$categories->execute();
	$result = array();
	while ($cdata = $categories->fetch()) {
		$result[$cdata['category_id']] = $cdata['cat_name'];
	}
	return $result;
}


class DB 
{
	private static $dbhandle;

	private static function init() 
	{
		$conn = "mysql:dbname=".OOLITE_MYSQL_DB.";host=".OOLITE_MYSQL_HOST;
		self::$dbhandle = new PDO($conn,OOLITE_MYSQL_USER,OOLITE_MYSQL_PASS);
		
		self::$dbhandle->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_ASSOC);
		self::$dbhandle->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	}

	public static function dbh() 
	{
		if (!self::$dbhandle)
		{
			self::init();
		}
		return self::$dbhandle;
	}

}
