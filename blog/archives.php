<?
include("settings.php");
$query = "SELECT title, blog_id, content, date_format(published, '%a, %b %d %Y %T') as published, display FROM `wfblog` WHERE display != '1' ORDER BY blog_id DESC";
$feeds = query($query);
$feed = mysql_fetch_assoc($feeds);
?>
<style type="text/css">
<!--
.smalldate {font-size: 10px}
-->
</style>

<?
do{
?>
<h3>
			<?= stripslashes($feed['title']); ?>
</h3>
	  <?= stripslashes($feed['content']); ?>

<br>
      <span class="smalldate">
      <?= stripslashes($feed['published']); ?>
       </span>


<?
}while($feed = mysql_fetch_assoc($feeds));
?>