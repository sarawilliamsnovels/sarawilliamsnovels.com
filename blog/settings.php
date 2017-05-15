<?
/*
 	settings.php
	by: Sosh Howell
	contact: sosh@swingthis.net
	desc: this page sets many of the default variables and functions that are used
		in the webfooted site monitor


UPDATE NOTES:
This version has a new database field podcast, as well as some new folders - files and icons, as well as an .htaccess file to help with uploaded file sizes.
		
	here is the SQL syntax for creating the needed table...
  
  		CREATE TABLE wfblog (
		  blog_id int(11) NOT NULL auto_increment,
		  title varchar(255) NOT NULL default '',
		  url varchar(255) NOT NULL,
		  podcast varchar(255) NOT NULL,
		  content text NOT NULL,
		  published timestamp NOT NULL default CURRENT_TIMESTAMP,
		  display char(1) default NULL,
		  PRIMARY KEY  (blog_id)
		 )

*/ 
$version = '1.1';

/* declare variables */
$db_type    = 'mysql';

$wfhostname = "localhost";
$wfdatabase = "discord_sarawilliamsnovelist";
$wfusername = "discord_sara";
$wfpassword = "s4r4";



// for future use dont set now...
$wftable    = "wfblog";

// COPY and bast these next two sections if you are replacing this file...

$users['Sara'] = 'cayou1';
#$users['User2'] = 'cayou1';


// basic blog settings for RSS feed - Edit this
$title = "Sara Williams Novelist";
$linked = "http://www.sarawilliamsnovels.com";
$desc = "Writer of The Don Juan Con and The Saranoa Scandal";

/* create a persistant connection */
$wflink = mysql_pconnect($wfhostname, $wfusername, $wfpassword) or trigger_error(mysql_error(),E_USER_ERROR); 
mysql_select_db($wfdatabase, $wflink);

function query($query){
	global $wflink;
	global $db_type;
	
	/* execute mysql code */
	if($db_type == "mysql"){
		
		$result =  mysql_query($query, $wflink) or die(mysql_error());
		return $result;
	}
}
?>
