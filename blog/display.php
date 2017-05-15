<?
session_start();
if(empty($_SESSION['username'])){ header('location: login.php'); }
require_once("settings.php");
$query = "
UPDATE `wfblog` SET 
`display` = '1' WHERE `blog_id` = '". $_REQUEST['blog_id']."' LIMIT 1 
";
$feeds = query($query);
header('location: index.php');

?>