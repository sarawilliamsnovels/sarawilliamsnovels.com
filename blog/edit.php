<?
session_start();
if(empty($_SESSION['username'])){ header('location: login.php'); }
ini_set("display_errors", "On");
require_once("settings.php");

include("upload.php");

if($_POST['blog_id'] != ''){
	include('update.php');
	header("location: index.php");

}
elseif($_POST['blog_id'] == '' && $_POST['title'] != ''){
	include('insert.php');
	header("location: index.php");
}

if(!empty($_GET['blog_id'])){
	$query = "SELECT title, blog_id, content, url, podcast, date_format(published, '%a, %b %d %Y %T') as publish, published, display FROM `wfblog` WHERE  blog_id = '". $_GET['blog_id']."'";
	$feeds = query($query);
	$feed = mysql_fetch_assoc($feeds);
}
//*/
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Create and Edit Blog</title>
<link href="register.css" rel="stylesheet" type="text/css">
</head>
<body>
<p><a href="edit.php"> Create New Post</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a href="index.php">Menu</a> </p>
<p class="section">Create/Edit Feed Item </p>
<form name="form1" method="post" enctype="multipart/form-data" action="">
  <p>
    <span class="item">Title</span>
    <input name="title" type="text" id="title" value="<?= stripslashes($feed['title']); ?>" size="80" maxlength="255">
    <input name="blog_id" type="hidden" id="blog_id" value="<?= $feed['blog_id']; ?>">
    <br>
    <br>
<!--    <span class="item">Full Article URL(<em>optional</em>)    </span>
    <input name="url" type="text" id="url" value="<?= $feed['url']; ?>" size="80">
		<br>-->
    <span class="item">Publish Date (Set to future date to publish at that time) </span>
	<?
	if(empty($feed['published'])){
		$q="select now() as published";
		$res = query($q);
		$feed = mysql_fetch_assoc($res);
	}
		$fst = explode(' ', $feed['published']);
		$date = explode('-', $fst[0]);
		$time = explode(':', $fst[1]);		

	?>
    <input name="yyyy" type="text" id="yyyy" value="<?= $date[0]; ?>" size="6" maxlength="4">
    <input name="mm" type="text" id="mm" value="<?= $date[1]; ?>" size="4" maxlength="2">
    <input name="dd" type="text" id="dd" value="<?= $date[2]; ?>" size="4" maxlength="2">
    &nbsp;&nbsp; 
    <input name="hh" type="text" id="hh" value="<?= $time[0]; ?>" size="4" maxlength="2">
    <input name="min" type="text" id="min" value="<?= $time[1]; ?>" size="4" maxlength="2">
    <input name="ss" type="text" id="ss" value="<?= $time[2]; ?>" size="4" maxlength="2">
    <br>
    <br>
		<!--
    <span class="item">Podcast File</span>
<? if (!empty($feed['podcast'])) { ?>
  <div id="filestored"><em>stored</em> <input type="button" value="Change..." onClick="document.getElementById('fileselect').style.display = '';document.getElementById('filestored').style.display = 'none';"></div>
    <div id="fileselect" style="display: none;"><input name="podcast" type="file" id="podcast" size="60"></div>
    <input type="hidden" name="storedpodcast" value="<?= $feed['podcast']; ?>">
<? } else { ?>
    <div><input name="podcast" type="file" id="podcast" size="60"></div>
<? } ?>
    <br>
		-->
    <br>
    <span class="item">Content</span>  <br>
    <textarea name="content" cols="90" rows="13" id="content"><?= stripslashes($feed['content']); ?></textarea>
    <br>
    <br>
    <input type="submit" name="Submit" value="Submit">
  </p>
</form>
</body>
</html>
