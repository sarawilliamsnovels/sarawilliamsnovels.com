<?
include("settings.php");
if ($_GET['item']) {
	$spec_item = true;	
	$ifAND = " AND blog_id = ".$_GET['item']." ";
} else {
	$spec_item = false;
}
$query = "SELECT title, blog_id, content, podcast, url, date_format( published, '%a, %d %b %Y ' ) AS published_date, display
FROM `wfblog`
WHERE display = '1' ".$ifAND."
ORDER BY published DESC";
$feeds = query($query);
$feed = mysql_fetch_assoc($feeds);
?>
<script language="JavaScript">
function openArticle(aid) {
	location.href="/news.php?item="+aid;
}
</script>
<style type="text/css">
<!--
.smalldate {font-size:9px; padding-top: 6px; }
.fullarticle {font-size: 11px}
.btitle {font-size: 16px; color: #000099; font-weight: bold; }

-->
</style>

<?
function cutdown($txt, $item) {
	global $spec_item;
	if ($spec_item) {
		return $txt;
	}
	if (strlen($txt) > 300) {
		$newtxt = substr($txt, 0, 300);
		$newtxt = preg_replace("/<img /", "<img height='120' align='right' border='1' onClick='openArticle(\"".$item."\")' ", $newtxt);
		$newtxt = preg_replace("/^<br>/", "", $newtxt);
		$newtxt = preg_replace("/^<br>/", "", $newtxt);
		$newtxt = preg_replace("/\w+$/", "...", $newtxt);
		$newtxt .= "<br>[<a href='/news.php?item=".$item."'> Read More </a>]";
	} else {
		$newtxt = $txt;
	}

	return $newtxt;
}
do {
?>
<div class="btitle"> <a style="text-decoration:none" href="/news.php?item=<?= $feed['blog_id']; ?>"><?= stripslashes($feed['title']); ?> </a></div>
	  <?=cutdown(stripslashes($feed['content']), $feed['blog_id']); ?>
	  <br>
      <div class="smalldate">
     Posted by <b>Sara</b> on <?=stripslashes($feed['published_date']); ?>
       </div><br>
	   <? if(!empty($feed['url'])){ ?>
	   <a class="fullarticle" href="<?= $feed['url']; ?>">Full Article: <?= stripslashes($feed['title']); ?></a>
		<? } ?>
		<? if ($spec_item) { ?>
			<br>
			<center>
				<a href='/index.php'>&lt; Return to Home Page</a>
			</center>
		<? } ?>
		<br>
<?
} while($feed = mysql_fetch_assoc($feeds));
?>
