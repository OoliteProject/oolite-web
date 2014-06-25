<?php

function admin_manifests() {
	if (isset($_GET['logout'])) {
		setcookie("login",false);
		admin_login_form();
	} else {
		if (!$user = admin_logged_in()) {
			admin_login_form();
		} else {
			admin_actions($user);
		}
	}
}


function admin_logged_in() {
	if (isset($_COOKIE['login'])) {
		$dbh = DB::dbh();
		$checklogin = $dbh->prepare("SELECT user_id,username FROM Users WHERE MD5(CONCAT(username,?,?)) = ?");
		$checklogin->execute(array(OOLITE_COOKIEHASH,date("Ymd"),$_COOKIE['login']));
		if ($result = $checklogin->fetch()) {
			define("OOLITE_AUTHED_PAGE",1);
			return $result['user_id'];
		}		
	}
	return false;
}


function admin_login_form() {
	if (isset($_POST['user'])) {
		$dbh = DB::dbh();
		$finduser = $dbh->prepare("SELECT user_id,username FROM Users WHERE username = ? AND password = MD5(CONCAT(?,?))");
		$finduser->execute(array($_POST['user'],$_POST['pass'],OOLITE_PWHASH));
		if ($result = $finduser->fetch()) {
			setcookie("login",md5($result['username'].OOLITE_COOKIEHASH.date("Ymd")));
			admin_actions($result['user_id']);
			return;
		} else {
			print ("<p>Incorrect username and password.</p>\n");
		}
	}
	print ("<form action='./' method='post'>\n");
	print ("<p>If you are a new expansion pack writer, you can request a username and password on the <a href='http://aegidian.org/bb/'>forums</a>.</p>"); // TODO: should have a specific thread for this
	print ("<fieldset><legend>Log in</legend>\n");
	print ("<div>Username: <input name='user'></div>\n");
	print ("<div>Password: <input name='pass' type='password'></div>\n");
	print ("<input type='submit' value='Log in'>");
	print ("</fieldset>\n");
	print ("</form>");
}


function admin_actions($user) {
	if (isset($_REQUEST['edit'])) {
		admin_edit_manifest($user,(int)$_REQUEST['edit']);
	} else if (isset($_REQUEST['cnpwd'])) {
		admin_change_password($user);
	} else {
		admin_menu($user);
	}
}

function admin_userdata($user) {
	$dbh = DB::dbh();
	$getuser = $dbh->prepare("SELECT user_id,username,name,email FROM Users WHERE user_id = ?");
	$getuser->execute(array($user));
	$udata = $getuser->fetch();
	if (!$udata) {
		$udata = array("user_id" => 0,
					   "username" => "",
					   "name" => "",
					   "email" => "");
	}
	return $udata;
}


function admin_menu($user) {
	$dbh = DB::dbh();
	$getmanifests = $dbh->prepare("SELECT manifest_id,active,identifier,title,version FROM Manifests WHERE uploaded_by = ? ORDER BY title, version");
	$getmanifests->execute(array($user));
	print ("<h2>Manage manifests</h2>");
	print ("<ul>");
	while ($mdata = $getmanifests->fetch()) {
		print ("<li><a href='./?edit=".$mdata['manifest_id']."'>".htmlspecialchars($mdata['title']." ".$mdata['version']." (".$mdata['active'].")")."</a></li>");
	}
	print ("</ul>");

	print ("<p><a href='./?edit=0'>New manifest</a></p>\n");

	print ("<h2>Manage account</h2>\n");
	print ("<p><a href='./?cnpwd=1'>Change password</a></p>\n");
	print ("<p><a href='./?logout=1'>Log out</a></p>\n");
}

function admin_edit_manifest($user,$manifest) {
	$udata = admin_userdata($user);
	if ($udata['user_id'] != $user) {
		print ("<p>User account not recognised</p>\n");
		return false;
	}
	print ("<p><a href='/admin/'>Return to admin index</a></p>\n");
	$dbh = DB::dbh();
	$mdata = false;
	if ($manifest > 0) {
		$getmanifest = $dbh->prepare("SELECT * FROM Manifests WHERE manifest_id = ? AND uploaded_by = ?");
		$getmanifest->execute(array($manifest,$user));
		$mdata = $getmanifest->fetch();
		// if not their manifest, this will create a new one
	}
	if (!$mdata) {
		// default values
		$mdata = array("manifest_id" => 0,
					   "active" => "Draft",
					   "identifier" => "",
					   "required_oolite_version" => OOLITE_DEFAULT_OXZ_OOLITE_VERSION,
					   "title" => "",
					   "version" => "1.0",
					   "category" => "",
					   "description" => "",
					   "download_url" => "",
					   "author" => $udata['username'],
					   "file_size" => "",
					   "information_url" => "",
					   "license" => "",
					   "maximum_oolite_version" => "",
					   "uploaded_by" => $udata['user_id'],
					   "upload_date" => date("Y-m-d H:i:s"));
	}

	if ($mdata['active'] == "Deleted") {
		print ("<p>This manifest entry has been deleted.</p>\n");
		return false;
	}
	
	if (isset($_POST['dependency'])) {
		admin_alter_dependency($udata,$mdata);
		admin_dependency_form($udata,$mdata);
	} else if (isset($_GET['dependency'])) {
		admin_dependency_form($udata,$mdata);
	} else if (isset($_POST['edit'])) {
		admin_alter_manifest($udata,$mdata);
		admin_manifest_form($udata,$mdata);
	} else {
		admin_manifest_form($udata,$mdata);
	}

}

function admin_form_text($mdata,$key,$size,$label,$help) {
	$fkey = current(explode("[",$key));
	print ("<tr class='field'><th>$label</th><td><input name='$key' value=\"".htmlspecialchars($mdata[$fkey])."\" size='$size'></td></tr><tr><td colspan='2'>$help</td></tr>\n");
}

function admin_form_bigtext($mdata,$key,$size,$label,$help) {
	$fkey = current(explode("[",$key));
	print ("<tr class='field'><th>$label</th><td><textarea name='$key' rows='4' cols='60'>".htmlspecialchars($mdata[$fkey])."</textarea></td></tr><tr><td colspan='2'>$help</td></tr>\n");
}

function admin_form_selector($mdata,$key,$options,$label,$help,$assoc=false) {
	print ("<tr class='field'><th>$label</th><td><select name='$key'>");
//.htmlspecialchars($mdata[$key]).
	$fkey = current(explode("[",$key));
	foreach ($options as $okey => $value) {
		if (!$assoc) { $okey = $value; }
		print ("<option value='$okey'");
		if ($mdata[$fkey] == $okey) {
			print (" selected='selected'");
		}
		print (">$value</option>");
	}
	print ("</select></td></tr><tr><td colspan='2'>$help</td></tr>\n");

}

function admin_form_dependency($mdata,$ddata) {
	$id = $ddata['dependency_id'];
	print ("<fieldset>\n");
	print ("<table>\n");
	admin_form_selector($ddata,"dependency_type[$id]",array("None","Required","Optional","Conflict"),"Dependency type","The type of dependency. Set to 'None' to delete an existing dependency or not add a new one.",false);
	admin_form_text($ddata,"dependency_identifier[$id]",50,"Identifier","The identifier of the dependency.");
	admin_form_text($ddata,"dependency_version[$id]",50,"Version","The minimum version of the dependency which this applies to (leave blank for all)");
	admin_form_text($ddata,"dependency_maximum_version[$id]",50,"Maximum Version","The maximum version of the dependency which this applies to (leave blank for all)");
	admin_form_bigtext($ddata,"dependency_description[$id]",255,"Description","A short description of the dependency. e.g. 'Example OXP 0.6 or above'");
	print ("</table>\n");
	print ("</fieldset>\n");
}

function admin_manifest_form($udata,$mdata) {
	print ("<form action='./' method='post'>");
	if ($mdata['manifest_id'] != 0) {
		print ("<p><a href='#currentmanifest'>View current manifest</a></p>\n");
	}
	print ("<fieldset><legend>Enter manifest details</legend>\n");
	print ("<input type='hidden' name='edit' value='".$mdata['manifest_id']."'>");
	print ("<input type='hidden' name='timestamp' value='".$mdata['upload_date']."'>");
	print("<fieldset><legend>Required fields</legend>\n");
	print ("<p>These fields are required by the manifest.plist format or by Oolite's installer.</p>\n<table>");
	admin_form_selector($mdata,"active",array("Draft","Active","Deleted"),"Status","Note: setting the status to Deleted will permanently remove the entry.");
	admin_form_text($mdata,"identifier",50,"Identifier","Unique identifier for this OXP. A unique prefix for the author followed by a unique suffix for the OXP is the best way to avoid clashes. Reverse-domain of your personal domain name is one way to get a unique author prefix; if, like many OXPers, you don't have a personal domain name, <code>oolite.oxp.<var>your_username</var></code> will also work.");
	admin_form_selector($mdata,"required_oolite_version",oolite_versions(),"Oolite version","The minimum required Oolite version to run this OXP. Since 1.79 is the first version to support manifest.plist files, there is no point in specifying earlier versions here.");
	admin_form_text($mdata,"title",50,"Title","The name of the OXP");
	admin_form_text($mdata,"version",50,"Version","The version of the OXP. major.minor.point format is required (with minor and point optional) for correct processing by the installer. All changes, no matter how small, require a new version number.");
	admin_form_selector($mdata,"category",oolite_oxp_categories(),"Category","The category of the OXP - <a href='http://wiki.alioth.net/index.php/OXP_List#OXP_Categories'>categorisation documentation</a>",true);
	admin_form_bigtext($mdata,"description",255,"Description","A short description of the OXP.");
	admin_form_text($mdata,"download_url",50,"Download URL","A URL which will directly download the OXZ file. To avoid possibly confusing players, it is best to change this URL for each new release if possible.");
	print ("</table></fieldset>\n");
	print("<fieldset><legend>Optional fields</legend>\n");
	print ("<p>These fields may be useful to provide additional information to players either through the installer or through other applications.</p>\n<table>");
	admin_form_text($mdata,"author",50,"Author","The author or authors of the OXP");
	admin_form_text($mdata,"file_size",15,"File size","The file size in bytes of the OXZ download.");
	admin_form_text($mdata,"information_url",50,"Information URL","A web page which provides more information about the OXP.");
	admin_form_text($mdata,"license",50,"License","A short summary of the license terms of the OXP (e.g. CC-BY-NC-SA 3.0). Note that since the purpose of this system is to allow players to download OXPs, using it requires you to grant a license to download and make copies for personal use, and that minimal permission will be assumed if this field is left blank.");
	admin_form_selector($mdata,"maximum_oolite_version",oolite_max_versions(),"Maximum Oolite version","If you know that this OXP is only applicable to versions of Oolite before a particular release, enter the latest applicable version here. Almost always this should be left blank for 'no maximum version'.");
	print ("</table></fieldset>\n");

	print ("<fieldset><legend>Dependencies</legend>\n");
	if ($mdata['manifest_id'] != 0) {
		$dbh = DB::dbh();
		$deps = $dbh->prepare("SELECT dependency_id,dependency_type,dependency_identifier,dependency_version,dependency_maximum_version,dependency_description FROM Dependencies WHERE manifest_id = ?");
		$deps->execute(array($mdata['manifest_id']));
		while ($ddata = $deps->fetch()) {
			admin_form_dependency($mdata,$ddata);
		}
	}
	print ("<p>Add a new dependency here</p>\n");
	admin_form_dependency($mdata,
						  array("dependency_id"=>0,
								"dependency_type"=>"None",
								"dependency_identifier" => "",
								"dependency_version" => "",
								"dependency_maximum_version" => "",
								"dependency_description" => ""));
	print ("</fieldset>\n");
	print ("</fieldset>\n");
	print ("<div><input type='submit' value='Update manifest'></div>\n");
	print ("</form>\n");
	if ($mdata['manifest_id'] != 0) {
		admin_show_manifest_plist($mdata);
	}
}

function admin_alter_manifest($udata,&$mdata) {
	if ($_POST['version'] != $mdata['version'] || $_POST['active'] != $mdata['active']) {
		// update the "last update" date if the version or manifest status changes
		$mdata['upload_date'] = date("Y-m-d H:i:s");
	}
	$mdata['manifest_id'] = admin_update_database($mdata,"Manifests","manifest_id",$_POST);
	foreach ($mdata as $k => $v) {
		if (isset($_POST[$k])) {
			$mdata[$k] = $_POST[$k];
		}
	}
	/* foreach dependency, update it, add it, or delete it */
	$dbh = DB::dbh();
	$verify = $dbh->prepare("SELECT dependency_id FROM Dependencies WHERE dependency_id = ? AND manifest_id = ?");
	$clear = $dbh->prepare("DELETE FROM Dependencies WHERE dependency_id = ?");
	foreach ($_POST['dependency_type'] as $idx => $dtype) {
		if ($idx == 0) {
			if ($dtype != "None") {
				// insert
				admin_update_database(admin_manifest_keys($idx,$mdata['manifest_id']),"Dependencies","dependency_id",array());
			}
			// else no new additions
		} else {
			$verify->execute(array($idx,$mdata['manifest_id']));
			if ($verify->fetch()) {
				if ($dtype == "None") {
					// delete
					$clear->execute(array($idx));
				} else {
					// update
					admin_update_database(admin_manifest_keys($idx,$mdata['manifest_id']),"Dependencies","dependency_id",array());
				}
			} /* else query returns no rows, so this dependency is no
				 longer attached to this manifest */
			
		}
	}

}

function admin_manifest_keys($idx,$manifest) {
	$keys = array(
		"dependency_id" => $idx,
		"manifest_id" => $manifest
		);
	foreach (array("dependency_type","dependency_identifier","dependency_version","dependency_maximum_version","dependency_description") as $field) {
		$keys[$field] = $_POST[$field][$idx];
	}
	return $keys;
}

function admin_update_database($keys,$table,$primary,$update) {
	$params = array();
	if ($keys[$primary] == 0) {
		$qkeys = array();		
		$qvals = array();
		foreach ($keys as $key => $val) {
			if ($key != $primary) {
				$qkeys[] = $key;
				$qvals[] = ":".$key;
				$params[":".$key] = isset($update[$key])?$update[$key]:$val;
			}
		}
		$keystr = join(",",$qkeys);
		$valuestr = join(",",$qvals);
		$query = "INSERT INTO $table ($keystr) VALUES ($valuestr)";
	} else {
		$updates = array();
		foreach ($keys as $key => $val) {
			if ($key != $primary) {
				$updates[] = $key." = :".$key;
				$params[":".$key] = isset($update[$key])?$update[$key]:$val;
			}
		}
		$updstr = join(",",$updates);
		$params[":".$primary] = $keys[$primary];
		$query = "UPDATE $table SET $updstr WHERE $primary = :$primary";
	}
	$dbh = DB::dbh();
	$process = $dbh->prepare($query);
	$process->execute($params);
	if ($keys[$primary] == 0) {
		return $dbh->lastInsertID();
	} else {
		return $keys[$primary];
	}
}


function admin_show_manifest_plist($mdata) {
	print ("<h2 id='currentmanifest'>Current manifest.plist</h2>");
	print ("<pre><code>".manifestString($mdata)."</code></pre>");
}

/* Password changing */

function admin_change_password($user) {

	if (isset($_POST['npwd']))	{
		if (strlen($_POST['npwd']) < 8) {
			print ("<p><strong>Password update failed</strong> - must be at least 8 characters</p>\n");
		} else {
			if ($_POST['npwd'] != $_POST['cnpwd']) {
				print ("<p><strong>Password update failed</strong> - confirmation password not the same</p>\n");
			} else {
				$query = "UPDATE Users SET password = MD5(CONCAT(?,?)) WHERE user_id = ? AND password = MD5(CONCAT(?,?))";
				$dbh = DB::dbh();
				$process = $dbh->prepare($query);
				$process->execute(array($_POST['npwd'],OOLITE_PWHASH,$user,$_POST['opwd'],OOLITE_PWHASH));
				if ($process->rowCount() == 1) {
					print ("<p><strong>Password updated successfully</strong></p>\n");
				} else {
					print ("<p><strong>Password update failed</strong> - incorrect password?</p>\n");
				}
			}
		}
	}

	print ("<p><a href='./'>Return to menu</a></p>\n");
	print ("<form action='./' method='post'>\n");
	print ("<fieldset><legend>Change password</legend>\n");
	print ("<table>\n");
	print ("<tr><th>Current password</th><td><input name='opwd' type='password'></td></tr>\n");
	print ("<tr><th>New password</th><td><input name='npwd' type='password'></td></tr>\n");
	print ("<tr><th>Repeat new password</th><td><input name='cnpwd' type='password'></td></tr>\n");
	print ("</table>\n");
	print ("<input type='submit' value='Change Password'>\n");
	print ("</fieldset>\n");
	print ("<p>Passwords must be at least 8 characters long</p>\n");
	print ("</form>\n");
}