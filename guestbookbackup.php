<?
/*

		// guestbook.php sign guestbook code
//		$ok = !strcmp($_REQUEST['cap_h'],md5($_REQUEST['cap_t'].$password)); $ok or print "capture not validated";
		$guestbook_temp = $_FORM['guestbook_post'];
		print $guestbook_temp;
		$guestbook_message = $_FORM['guestbook_message'];
		$guestbook_signed = $_FORM['guestbook_signed'];
		// guestbook_date just using now, used to be php: date("l jS \of F Y h:i A");
		$guestbook_personal = $_FORM['guestbook_personal'];
		// !!!
		$guestbook_public_int = 0;

		mysql_connect(localhost, "discord_discord", "r10tv123");
		@mysql_select_db("discord_guestbook");
*/	
	//			if ($_FORM['submit'] == "POST") {
		
			if ($_POST){	
				require_once('recaptchalib.php');
				$privatekey = "6LeS4wsAAAAAAGWLm33fYTr_X1tOwiwgjtsY1tWI";
				$resp = recaptcha_check_answer ($privatekey,
				$_SERVER["REMOTE_ADDR"],
				$_POST["recaptcha_challenge_field"],
				$_POST["recaptcha_response_field"]);
			if (!$resp->is_valid) {
				die ("The reCAPTCHA wasn't entered correctly. Go back and try it again." .
			"(reCAPTCHA said: " . $resp->error . ")");
			}
		
			mysql_connect(localhost, "discord_discord", "r10tv123");
			@mysql_select_db("discord_guestbook");
		

			print $guestbook_temp;
			print "in submit";	
		
			$query='INSERT INTO guestbook (name,message) VALUES (\'Robert\', \'rob@seattlesoft.com\')'
			}
		//	$query="INSERT INTO discord_guestbook.guestbook SET "+
		//		" name = '"+$guestbook_signed+"',"+
		//		" message = '"+$guestbook_message+"',"+
		//		" postedtime = now(), "+
		//		" public = '"+$guestbook_public_int+";";
//			mysql_query($query);
//			mysql_close();
		

	
//	$sql = "SELECT * FROM discord_guestbook.guestbook";
//	print $query;
//	$query = "SELECT name,message,postedtime,public FROM discord_guestbook";
//	$result = mysql_query($query);
//	print $result;
//	}
/*	while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
		echo $row['name'];
		//echo $row['message'];
		//echo $row['postedtime'];
		//echo $row['public'];
	}	
*/

?>


<html>
<head> 
	<title>Sara Williams, Novelist</title>
	<meta name="title" content="Sara Wiliams, Novelist"> 
	<meta name="description" content="Author of three ArcheBooks best-selling mystery novels, The Serenoa Scandal, The Don Juan Con and One Big Itch."> 
	<meta name="keywords" content="mystery novels,mystery writers,don juan con,serenoa scandal,sara williams,good mystery novels,favorite books">
	<meta name="rating" content="General">
	<meta name="content-language" content="english">
	<meta name="resource-type" content="document">
	<meta name="robots" CONTENT="index,follow">
	<link rel="stylesheet" type="text/css" href="style.css" media="all" />
</head>

<script language="JavaScript" src="/bookmark.js"></script>
<script language="JavaScript" src="/analytics.js"></script>

<body>

	<span id="leftside">
	
		<a href='javascript:CreateBookmarkLink();'><img src='images/bookmark.png' border='0'></a>
		
		<br/>
		<center>
		<div class="lbuttons">
			<a href='index.html'><img src="images/icon_home.png" border='0'><br/>Home</a><br/><br/>
			<a href='books.html'><img src="images/icon_books.png" border='0'><br/>Books</a><br/><br/>
			<a href='media.html'><img src="images/icon_media.png" border='0'><br/>Media</a><br/><br/>
			<a href='guestbook.html'><img src="images/icon_guestbook.png" border='0'><br/>Guestbook</a><br/><br/>
			<a href='mailto:sara@sarawilliamsnovels.com'><img src="images/icon_email.png" border='0'><br/>E-Mail</a><br/><br/>
			<a href='links.html'><img src="images/icon_links.png" border='0'><br/>Links</a><br/><br/>
		</div>
		</center>
	</span>
	
	<br/>
	<table cellpadding="0" cellspacing="0" border="0" width="655">
		<tr><td><img src="images/title.png"></td></tr>
		<tr><td><img src="images/book_top.png"></td></tr>
		<tr><td background="images/book_body.png">
			<div id="mainbox">
			
				<h2>Sign my guestbook</h2>
				I'd be delighted if you would sign my guestbook!  I love to hear from readers and friends. <br/><br/>
			
				You can type a guestbook message here:
				<form action="guestbook.php" method="post">
			
				<textarea name="guestbook_post" rows="6" cols="40" style="font-size: 120%">We are fixing the guestbook in order to prevent spammers from posting junk here!  Please wait a few days and visit us again! 
	Thanks
	-Winston Williams Feb 9 2010</textarea><br/>
			
				<font color="red"><b>Unfortunately, spammers make it difficult to keep websites free from junk postings, you have to type the letters from the image below before you can press "Sign Guestbook"</b></font><br/><br/>
			
				<!-- recaptcha provided captcha spam block -Colin 03/17/2010 -too many junk posts- -->
   				<?php
     					require_once('recaptchalib.php');
     					$publickey = "6LeS4wsAAAAAAFzohmupe2GLJkbZh_Ybn9hgnBlw"; // you got this from the signup page
     					echo recaptcha_get_html($publickey);
   					?>
   				<input type="submit" value="Sign Guestbook"/>
		
				<br/>
				<input type="checkbox" name="guestbook_personal">This is a personal note, please do not display on website</input><br/><br/>
				</form>			
			
				<br/><br/>
				
				<h2>Guestbook:</h2>
				
				<br/><br/>
							
			</div>
			
		</td></tr>
		<tr><td background="images/book_body.png" align="center">
			<span id="copyright">&copy;Copyright 2010 Sara Williams</span>
		</td></tr>
	</table>	
</body>
</html>
