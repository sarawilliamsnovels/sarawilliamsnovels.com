<?
session_start();
if(empty($_SESSION['username'])){ header('location: login.php'); }
require_once("settings.php");
$query = "
DELETE FROM wfblog WHERE  blog_id = '". $_REQUEST['blog_id']."'
";
$feeds = query($query);
header('location: index.php');

?>