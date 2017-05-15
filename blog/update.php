<?
session_start();
if(empty($_SESSION['username'])){ header('location: login.php'); }
require_once("settings.php");
$query = "
UPDATE `wfblog` SET `title` = '".addslashes( $_REQUEST['title'])."',
`content` = '". addslashes($_REQUEST['content'])."',
`url` = '".$_REQUEST['url']."',
`podcast` = '".$_REQUEST['podcast']."',
`published` = '".$_REQUEST['yyyy']."-".$_REQUEST['mm']."-".$_REQUEST['dd']." ".$_REQUEST['hh'].":".$_REQUEST['min'].":".$_REQUEST['ss']."' WHERE `blog_id` = '". $_REQUEST['blog_id']."' LIMIT 1
";
$feeds = query($query);

?>