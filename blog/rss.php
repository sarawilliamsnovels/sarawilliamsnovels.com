<?
include("settings.php");
header('Content-type: application/xml');
		echo "<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?>\n";
		echo "<rss version=\"2.0\">\n";
		echo "\t<channel>\n";
		//Required channel fields
		echo "\t\t<title>".$title."</title>\n";
		echo "\t\t<link>".$linked."</link>\n";
		echo "\t\t<description><![CDATA[".$desc."]]></description>\n";

$query = "SELECT title, blog_id, content, podcast, url, date_format( published, '%a, %d %b %Y %T' ) AS published, display
FROM `wfblog`
WHERE display = '1'
AND published < now( )
ORDER BY blog_id DESC ";
$feeds = query($query);
$feed = mysql_fetch_assoc($feeds);

do{

			echo "\t\t<item>\n";
			
			echo "\t\t\t<title>". stripslashes($feed['title'])."</title>\n";
			if(empty($feed['url'])){
				echo "\t\t\t<link>". $linked."</link>\n";  
			}
			else{
				echo "\t\t\t<link>". $feed['url'] ."</link>\n";  
			}
			echo "\t\t\t<description><![CDATA[". stripslashes($feed['content'])."]]>" . "</description>\n";
			//Optional item fields
			//echo "\t\t\t<guid isPermaLink=\"true\">". $linked."</guid>\n"; 
			echo "\t\t\t<pubDate>". stripslashes($feed['published'])." CST</pubDate>\n";
if(!empty($feed['podcast'])){			echo "\t\t\t<enclosure url=\"". $feed['podcast']."\" length=\"1636687\" type=\"audio/mpeg\"/>\n"; }
			echo "\t\t</item>\n";
			
			

}while($feed = mysql_fetch_assoc($feeds));
//*/

		echo "\t</channel>\n";
				echo "</rss>	";




?>