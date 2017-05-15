<?php	

                $guestbook_message='';
                $guestbook_name='';
                $guestbook_note = $_POST['guestbook_personal'];
				$guestbook_message = $_POST['guestbook_post'];
                $guestbook_name =$_POST['guestbook_name'];
                $guestbook_date = date("l jS \of F Y h:i A");
				$guestbook_public=1;

	if ($_POST){	
			
			if(!isset($guestbook_message) || !isset($guestbook_name)){
				//echo $guestbook_message.$guestbook_date;
				die("Please enter a message, and your name");
			}
			
			require_once('recaptchalib.php');
				$privatekey = "6LeS4wsAAAAAAGWLm33fYTr_X1tOwiwgjtsY1tWI";
				$resp = recaptcha_check_answer ($privatekey,$_SERVER["REMOTE_ADDR"],$_POST["recaptcha_challenge_field"],$_POST["recaptcha_response_field"]);
			if (!$resp->is_valid) {
				$caperr="The reCAPTCHA was not entered correctly. Go back and try it again";
			
			}else {
		
			mysql_connect(localhost, "discord_discord", "r10tv123");
			@mysql_select_db("discord_guestbook");
			//echo mysql_real_escape_string('password") OR "1"=="1";DROP TABLE CREDITCARDS--');
			
			

			//print $guestbook_temp;
			$query='INSERT INTO guestbook (name,message,datetime,public,displaydate) VALUES ("'.$guestbook_name.'", "'.$guestbook_message.'",NOW(),"'.$guestbook_public.'","'.$guestbook_date.'")';
			mysql_query($query);
			//echo $query;
			}
			//$query='INSERT INTO guestbook (name,message,postedtime,public) VALUES (\'mysql_real_escape_string($guestbook_name)\', \'rob@seattlesoft.com\')';
			}
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
			<a href='guestbook.php'><img src="images/icon_guestbook.png" border='0'><br/>Guestbook</a><br/><br/>
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
				<br/>
				
				<?php 
				mysql_connect(localhost, "discord_discord", "r10tv123");
				@mysql_select_db("discord_guestbook");
				$query='select name,message,displaydate from guestbook';
				$sqlfetch=mysql_query($query);
				
				while ($gbarray= mysql_fetch_array($sqlfetch)) {
					$message[] = $gbarray['message'];
					$names[] = $gbarray['name'];
					$date[] = $gbarray['displaydate'];
				}	
					for($i=0;$i<count($message);$i++) {
						
						echo '<h2>'.$message[$i].'</h2>';
						echo "<br>";
						echo $names[$i];
						echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
						echo $date[$i];
						echo "<br> <br>";
				}
				
				
				 
				
				?>
				<br/>
			
				<h2>Sign my guestbook</h2>
				I'd be delighted if you would sign my guestbook!  I love to hear from readers and friends. <br/><br/>
			
				You can type a guestbook message here:
				<form action="guestbook.php" method="POST">
				
				<textarea id="guestbook_post" name="guestbook_post" rows="6" cols="40" style="font-size: 120%"><?php if (!($guestbook_message=='')) echo "$guestbook_message";?></textarea><br/>
				
				<br/><br/>
				
				Name: <input id="guestbook_name" name="guestbook_name" type="text" value="<?php echo $guestbook_name;?>" size="20" maxlength="40"> <br />
				
				<br/><br/>
				<font color="red"><b>Unfortunately, spammers make it difficult to keep websites free from junk postings, you have to type the letters from the image below before you can press "Sign Guestbook"</b></font><br/><br/>
			
				<!-- recaptcha provided captcha spam block -Colin 03/17/2010 -too many junk posts- -->
   				 <?php
     					require_once('recaptchalib.php');
     					$publickey = "6LeS4wsAAAAAAFzohmupe2GLJkbZh_Ybn9hgnBlw"; // you got this from the signup page
     					echo recaptcha_get_html($publickey);
   					 
				?>
				<br/>
				
   				<input type="submit" value="Sign Guestbook"/>
		
				
				
				<input type="checkbox" name="guestbook_personal">This is a personal note, please do not display on website</input><br/><br/>
				
				</form>			
			
				<br/><br/>
				
				
				<br/><br/>
							
			</div>
			
		</td></tr>
		<tr><td background="images/book_body.png" align="center">
			<span id="copyright">&copy;Copyright 2010 Sara Williams</span>
		</td></tr>
	</table>
	<?php 
	if (!($caperr=='')) {
	echo "<script language='javascript'>window.alert('".$caperr."');</script>";
	}
	?>	
</body>
</html>
