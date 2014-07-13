<?php

function getOXZs($sort) {
	switch ($sort) {
	case "c":
		$order = "C.cat_name,M.title";
		break;
	case "a":
		$order = "M.author,M.title";
		break;
	case "d":
		$order = "M.upload_date DESC";
		break;
	case "t":
	default:
		$order = "M.title";
	}
	$db = DB::dbh();
	$q = $db->prepare("SELECT C.cat_name AS category, M.title, M.information_url, M.description, M.author, M.download_url, M.version, UNIX_TIMESTAMP(M.upload_date) AS released FROM Manifests M INNER JOIN Categories C ON (M.category = C.category_id) WHERE ".liveManifestConditions()." ORDER BY $order");
	$q->execute(array());
	return $q;
}

function liveManifestConditions() {
	return "M.active = 'Active' AND M.identifier != '' AND M.title != '' AND M.download_url != '' AND M.version != ''";
}

function manifestString($mdata) {
	$dbh = DB::dbh();
	$catname = $dbh->prepare("SELECT cat_name FROM Categories WHERE category_id = ?");
	$plist = "{\n";
	foreach ($mdata as $k => $v) {
		if ($k != "manifest_id" && $k != "uploaded_by" && $k != "upload_date" && $k != "active") {
			if ($v) {
				if ($k == "category") {
					$catname->execute(array($v));
					$cdata = $catname->fetch();
					$v = $cdata['cat_name'];
				}
				$plist .= "\t\"$k\" = \"".str_replace('"','\"',$v)."\";\n";
			}
		}
	}
	/* add tags */
	$tags = $dbh->prepare("SELECT tag FROM Tags WHERE manifest_id = ?");
	$tags->execute(array($mdata['manifest_id']));
	$tlines = array();
	while ($tdata = $tags->fetch()) {
		$tlines[] = "\t\t\"".str_replace('"','\"',$tdata['tag'])."\"";
	}
	if (count($tlines) > 0) {
		$plist .= "\t\"tags\" = (\n";
		$plist .= join(",\n",$tlines)."\n";
		$plist .= "\t);\n";
	}
	/* add dependencies */
	$deps = $dbh->prepare("SELECT dependency_identifier AS identifier,dependency_version AS version,dependency_maximum_version AS maximum_version,dependency_description AS description FROM Dependencies WHERE dependency_type = ? AND manifest_id = ?");
	$types = array("Required"=>"requires_oxps",
				   "Optional"=>"optional_oxps",
				   "Conflict"=>"conflict_oxps");
	foreach ($types as $type => $plistkey) {
		$deps->execute(array($type,$mdata['manifest_id']));
		$sublists = array();
		while ($ddata = $deps->fetch()) {
			$sublist = "\t\t{\n";
			if (trim($ddata['identifier']) != "")
			{
				foreach ($ddata as $k => $v) {
					if (trim($v) != "")
					{
						$sublist .= "\t\t\t\"$k\" = \"".str_replace('"','\"',$v)."\";\n";
					}
				}
			}
			$sublist .= "\t\t}";
			$sublists[] = $sublist;
		}
		if (count($sublists) > 0) {
			$plist .= "\t\"$plistkey\" = (\n";
			$plist .= join(",\n",$sublists);
			$plist .= "\n\t);\n";
		}
	}
	$plist .= "}\n";
	return $plist;
}
