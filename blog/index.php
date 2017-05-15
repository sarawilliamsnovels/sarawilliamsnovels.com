<?
session_start();
if(empty($_SESSION['username'])){ header('location: login.php'); }
include("settings.php");
$query = "SELECT title, blog_id, content, date_format(published, '%a, %b %d %Y %T') as published_date, display FROM `wfblog` WHERE display = '1' ORDER BY published DESC";
$feeds = query($query);

$query = "SELECT title, blog_id, content, date_format(published, '%a, %b %d %Y %T') as published_date, display FROM `wfblog` WHERE display != '1' ORDER BY published DESC";
$archives = query($query);

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Blog - <?= $title; ?></title>

<style type="text/css">
<!--
.style1 {
	font-size: 16px;
	font-weight: bold;
}
-->
</style>
<link href="register.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="basics.js"></script>
</head>
<body>

<a href="javascript:expand('live');" class="section">Blog - <?= $title; ?></a>
<p>
<a href='index.php'>Blog</a> | <a href='events.php'>Events</a><br>
<hr size='5'>
<br><a href="edit.php">Create New Post</a><br><br>
<!--
<div id="futurefeeds" ><span class="item">Future Feeds</span>
<? if(mysql_num_rows($futurefeeds) == 0){ ?>
<span class="note">There are no future feeds.</span> 
<? } ?>
  <?
for ($i = 0; $i < mysql_num_rows($futurefeeds); $i++) {
	$feed = mysql_fetch_assoc($futurefeeds)
?>
  <a href="edit.php?blog_id=<?= stripslashes($feed['blog_id']); ?>" class="style1">
  <?= stripslashes($feed['title']); ?>
    (edit)</a><br>
  <?= substr(stripslashes(strip_tags($feed['content'])), 0, 45) ; ?>
  <? if(strlen(stripslashes($feed['content'])) > 45){ echo "..."; } ?>
  <br>
  <?= stripslashes($feed['published']); ?>
  <br>
  <a href="delete.php?blog_id=<?= stripslashes($feed['blog_id']); ?>">Delete Entry</a> <br>
  <a href="archive.php?blog_id=<?= stripslashes($feed['blog_id']); ?>">Archive Entry</a> <br>
  <br>
  <?
}
?>
</div>
-->

<div id="live" >
<span class="item">Current Posts</span>
<div class="indent">
<? if(mysql_num_rows($feeds) == 0){ ?>
<span class="note">There are no current posts.</span> <br>
<? } ?>
<?
//for ($i = 0; $i < mysql_num_rows($feeds); $i++) {
//	$feed = mysql_fetch_assoc($feeds)
while ($feed = mysql_fetch_array($feeds)) {
?>
            <a href="edit.php?blog_id=<?= stripslashes($feed['blog_id']); ?>" class="style1">
          <?= stripslashes($feed['title']); ?> 
          (edit)</a><br>
  
  <?= substr(stripslashes(strip_tags($feed['content'])), 0, 45) ; ?>
  <? if(strlen(stripslashes($feed['content'])) > 45){ echo "..."; } ?>
  <br>
    <?= stripslashes($feed['published_date']); ?>
  <br>
  
	<font size='2'><a href="delete.php?blog_id=<?= stripslashes($feed['blog_id']); ?>">Delete Entry</a> | <a href="archive.php?blog_id=<?= stripslashes($feed['blog_id']); ?>">Archive Entry</a></font>
  <br>
	<hr width='200' align='left'>
 <br>
 
  
  <?
}
?>
</div>
<br></div>
</p>
<a href="javascript:expand('archives');" class="section">Archives</a>
<div class="indent">
<div  id="archives"><?
for ($i = 0; $i < mysql_num_rows($archives); $i++) {
	$archive = mysql_fetch_assoc($archives)
?>
    	<br>
<a href="edit.php?blog_id=<?= stripslashes($archive['blog_id']); ?>" class="style1"><?= stripslashes($archive['title']); ?> (edit)</a><br>

	    <?= substr(stripslashes(strip_tags($archive['content'])), 0, 45) ; ?><? if(strlen(stripslashes(strip_tags($archive['content']))) > 45){ echo "..."; } ?><br>
      <?= stripslashes($archive['published_date']); ?><br>

<a href="delete.php?blog_id=<?= stripslashes($archive['blog_id']); ?>">Delete Entry</a>
<br>
<a href="display.php?blog_id=<?= stripslashes($archive['blog_id']); ?>">Relist Entry</a>
<br>


<?
}
?></div>
</div>
<!--
<p><a href="javascript:expand('Howto');" class="section">How To... (and important files) </a></p>
<div id="Howto">
  <strong>Running version 
  <?= $version; ?> 
 of (<a href="http://www.webfooted.net/wfblog.php">
 <? include('http://www.webfooted.net/wfblogversion.php'); ?> </a>
 )<br>
    </strong><a href="rss.php">rss.php</a><br>
  XML  file for  

RSS and Podcast feeds <br>
The html that is used to show that a page has an RSS feed associated with it is... <br>
&lt;link rel="alternate" type="application/rss+xml" title="Subscribe To <em><strong>YourSite</strong></em> RSS 2.0 Feed" href="/podcast/rss.php" &gt;<br>
It is also reccomeded that you place the full link to your feed in a format such as...<br>
http://www.jukeboxalive.com/podcast/rss.php (to get your url click on <a href="rss.php">rss.php</a>) <br>
<br>
<a href="content.php">content.php</a><br>
HTML page for content display. Incude this file on any page that you want to display the content of the feed. Modify to custom fit your design needs. <br>
<br>
<a href="archives.php">archives.php</a><br>
HTML page for archived content display. See content.php. </div>
<sczzript type="text/javascript">
expand('archives');
expand('Howto');
</script>
-->
<br><br>
</body>
</html>
