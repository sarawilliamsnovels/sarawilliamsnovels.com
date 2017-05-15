<?
session_start();
if(empty($_SESSION['username'])){ header('location: login.php'); }
require_once("settings.php");
$query = "INSERT INTO `wfblog` 
( `blog_id` , `title` , `content` , `published` , `display`, `url`, `podcast` ) VALUES 
('', '". addslashes($_REQUEST['title'])."', '". addslashes($_REQUEST['content'])."', 
'".$_REQUEST['yyyy']."-".$_REQUEST['mm']."-".$_REQUEST['dd']." ".$_REQUEST['hh'].":".$_REQUEST['min'].":".$_REQUEST['ss']."' ,
 '1', '".$_REQUEST['url']."', '".$_REQUEST['podcast']."')";
$feeds = query($query);
?>