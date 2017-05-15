<?
include("settings.php");
$query = "UPDATE `wfblog` SET display = 0 WHERE blog_id = '".$_GET['blog_id']."'";
query($query);
$query = "SELECT title, blog_id, content, podcast, url, date_format( published, '%a, %d %b %Y ' ) AS published_date, display
FROM `wfblog`
WHERE display != '1'
ORDER BY published DESC";
$feeds = query($query);
$feed = mysql_fetch_assoc($feeds);
?>
<style type="text/css">
<!--
.smalldate {font-family: times; font-size:9px; padding-top: 6px; }
.fullarticle {font-size: 11px}
.btitle {font-family: verdana; font-size: 16px; color: #000099; font-weight: bold; }
-->
</style>

<?
do{
?>
<div class="btitle"> <?= stripslashes($feed['title']); ?> </div>
	  <?=  stripslashes($feed['content']); ?>
	  <br>
      <div class="smalldate">
     Posted by <b>Sara</b> on <?=stripslashes($feed['published_date']); ?>
       </div><br>
	   <? if(!empty($feed['url'])){ ?>
	   <a class="fullarticle" href="<?= $feed['url']; ?>">Full Article: <?= stripslashes($feed['title']); ?></a>
		<? } ?>

<?
}while($feed = mysql_fetch_assoc($feeds));
?>
