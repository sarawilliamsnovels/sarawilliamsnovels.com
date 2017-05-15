<?
include("settings.php");
$query = "SELECT title, blog_id, content, date_format(published, '%a, %b %d %Y %T') as published, display FROM `wfblog` WHERE display = '1'";
$feeds = query($query);
$feed = mysql_fetch_assoc($feeds);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Untitled Document</title>
</head>
<?
do{
?>
    	<?= stripslashes($feed['title']); ?><br>

	    <?= substr(stripslashes($feed['content']), 0, 45) ; ?><br>
      <?= stripslashes($feed['published']); ?>


<?
}while($feed = mysql_fetch_assoc($feeds));
?>
<body>

</body>
</html>
