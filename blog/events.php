<?php

session_start();
if(empty($_SESSION['username'])){ header('location: login.php'); }
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Events - Sara Williams Novelist</title>
</head>
<body>
<b>Events - Sara Williams Novelist</b><br>
<hr>
<a href='index.php'>Blog</a> | <a href='events.php'>Events</a><br>
<hr size='5'>

<?php
$db['username'] = 'discord_sara';
$db['password'] = 's4r4';
$db['hostname'] = 'localhost';
$db['database'] = 'discord_sarawilliamsnovelist';

$db['link'] = mysql_connect($db['hostname'], $db['username'], $db['password']) or die (mysql_error());
mysql_select_db($db['database'], $db['link']) or die (mysql_error());


if ( isset($action) )
{
	if ($action == 'add')
	{
		if ($_SERVER['REQUEST_METHOD'] == 'POST')
		{
			if ($_POST['date']['am_pm'] == 'PM' && $_POST['date']['hour'] != 12)
				$_POST['date']['hour'] += 12;
			if ($_POST['date']['am_pm'] == 'AM' && $_POST['date']['hour'] == 12)
				$_POST['date']['hour'] = '00';
			$sql_date = $_POST['date']['year'] . "-" . $_POST['date']['month'] . "-" . $_POST['date']['day'] . " " . $_POST['date']['hour'] . ":" . $_POST['date']['min'];
			$sql = "INSERT INTO `events` (id, `when`, location, city, comments, deleted) VALUES (NULL, '$sql_date', '$_POST[location]', '$_POST[city]', '$_POST[comments]', '0');";
			mysql_query($sql) or die (mysql_error());
			print "Added.\n";
			
		}
		else
		{
			$current_year = date("Y");
			print "<form action='$_SERVER[PHP_SELF]?action=add' method='POST'>\n";
			print "<h3>Add Event</h3>\n";
			print "<table border='0' cellpadding='0' cellspacing='2'>\n";
			print "\t<tr>\n";
			print "\t\t<td>Date:</td>\n";
			print "\t\t<td>\n";
			print "\t\t\tMonth:<select name='date[month]' size='1'>\n";
			
			for ($i = 1; $i <= 12; $i++)
			{
				$num = zeropad ($i, 2);
				print "\t\t\t\t<option>$num\n";
			}
			
			print "\t\t\t</select>\n";
			print "\t\t\tDay:<select name='date[day]' size='1'>\n";
			
			for ($i = 1; $i <= 31; $i++)
			{
				$num = zeropad ($i, 2);
				print "\t\t\t\t<option>$num\n";
			}
			
			print "\t\t\t</select>\n";
			print "\t\t\tYear:<select name='date[year]' size='1'>\n";
			
			for ($i = $current_year - 5; $i <= $current_year + 5; $i++)
			{
				if ($i == $current_year)
					print "\t\t\t\t<option selected>$i\n";
				else
					print "\t\t\t\t<option>$i\n";
			}
			
			print "\t\t\t</select>\n";
			print "\t\t</td>\n";
			print "\t</tr>\n";
			print "<tr><td colspan='2'>&nbsp;</tr>\n";
			print "\t<tr>\n";
			print "\t\t<td>Time:</td>\n";
			print "\t\t<td>\n";
			print "\t\t\t<select name='date[hour]' size='1'>\n";
			print "\t\t\t\t<option>01\n";
			print "\t\t\t\t<option>02\n";
			print "\t\t\t\t<option>03\n";
			print "\t\t\t\t<option>04\n";
			print "\t\t\t\t<option>05\n";
			print "\t\t\t\t<option>06\n";
			print "\t\t\t\t<option>07\n";
			print "\t\t\t\t<option>08\n";
			print "\t\t\t\t<option>09\n";
			print "\t\t\t\t<option>10\n";
			print "\t\t\t\t<option>11\n";
			print "\t\t\t\t<option>12\n";
			print "\t\t\t</select>\n";
			print "\t\t\t: <select name='date[min]' size='1'>\n";
			print "\t\t\t\t<option>00\n";
			print "\t\t\t\t<option>15\n";
			print "\t\t\t\t<option>30\n";
			print "\t\t\t\t<option>45\n";
			print "\t\t\t</select>\n";
			print "\t\t\t<select name='date[am_pm]' size='1'>\n";
			print "\t\t\t\t<option>AM\n";
			print "\t\t\t\t<option>PM\n";
			print "\t\t\t</select>\n";
			print "\t\t</td>\n";
			print "\t</tr>\n";
			print "<tr><td colspan='2'>&nbsp;</tr>\n";
			print "\t<tr>\n";
			print "\t\t<td>City/State:</td>\n";
			print "\t\t<td><input type='text' name='city' size='25'></td>\n";
			print "\t</tr>\n";
			print "\t<tr>\n";
			print "\t\t<td>Location:</td>\n";
			print "\t\t<td><input type='text' name='location' size='25'></td>\n";
			print "\t</tr>\n";
			print "\t<tr>\n";
			print "\t\t<td>Comments:</td>\n";
			print "\t\t<td><textarea name='comments' rows='10' cols='30'></textarea></td>\n";
			print "\t</tr>\n";
			print "\t<tr>\n";
			print "\t\t<td colspan='2'><input type='submit' value='Add'></td>\n";
			print "\t</tr>\n";
			print "</table>\n";
			print "</form>\n";
		}
	}
	elseif ($action == 'delete')
	{
		if ( !isset($id) | empty($id) )
			die ("<b>ERROR: bad ID given</b>");
		
		$sql = "UPDATE events SET deleted = 1 WHERE id = $id LIMIT 1;";
		mysql_query($sql) or die (mysql_error());
		print "Done.<br>\n";
	}
	elseif ($action == 'edit')
	{
		if ( !isset($id) | empty($id) )
			die ("<b>ERROR: bad ID given</b>");
		
		if ($_SERVER['REQUEST_METHOD'] == 'POST')
		{
			if ($_POST['date']['am_pm'] == 'PM' && $_POST['date']['hour'] != 12)
				$_POST['date']['hour'] += 12;
			if ($_POST['date']['am_pm'] == 'AM' && $_POST['date']['hour'] == 12)
				$_POST['date']['hour'] = '00';
			
			$sql_date = $_POST['date']['year'] . "-" . $_POST['date']['month'] . "-" . $_POST['date']['day'] . " " . $_POST['date']['hour'] . ":" . $_POST['date']['min'];

			$sql = "UPDATE events SET `when` = '$sql_date', location = '$_POST[location]', city = '$_POST[city]', comments = '$_POST[comments]' WHERE id = $id LIMIT 1;";
			mysql_query($sql) or die (mysql_error());
			print "Saved.\n";
		}
		else
		{
			$sql = "SELECT * FROM events WHERE id='$id';";
			$result = mysql_query ($sql) or die(mysql_error());

			$row = mysql_fetch_assoc($result);
			
			$today = getdate();
			$row_date = getdate( strtotime($row['when']) );
			print "<form action='$_SERVER[PHP_SELF]?action=edit&id=$id' method='POST'>\n";
			print "<h3>Edit Event</h3>\n";
			print "<table border='0' cellpadding='0' cellspacing='2'>\n";
			print "\t<tr>\n";
			print "\t\t<td>Date:</td>\n";
			print "\t\t<td>\n";
			print "\t\t\tMonth:<select name='date[month]' size='1'>\n";

			for ($i = 1; $i <= 12; $i++)
			{
				$num = zeropad ($i, 2);
				if ($i == $row_date['mon'])
					print "\t\t\t\t<option selected>$num\n";
				else
					print "\t\t\t\t<option>$num\n";
			}

			print "\t\t\t</select>\n";
			print "\t\t\tDay:<select name='date[day]' size='1'>\n";

			for ($i = 1; $i <= 31; $i++)
			{
				$num = zeropad ($i, 2);
				if ($i == $row_date['mday'])
					print "\t\t\t\t<option selected>$num\n";
				else
					print "\t\t\t\t<option>$num\n";
			}

			print "\t\t\t</select>\n";
			print "\t\t\tYear:<select name='date[year]' size='1'>\n";

			for ($i = $row_date['year'] - 5; $i <= $row_date['year'] + 5; $i++)
			{
				if ($i == $row_date['year'])
					print "\t\t\t\t<option selected>$i\n";
				else
					print "\t\t\t\t<option>$i\n";
			}

			print "\t\t\t</select>\n";
			print "\t\t</td>\n";
			print "\t</tr>\n";
			print "\t<tr>\n";
			print "\t\t<td>Time:</td>\n";
			print "\t\t<td>\n";
			print "\t\t\t<select name='date[hour]' size='1'>\n";
			print "\t\t\t\t<option>01\n";
			print "\t\t\t\t<option>02\n";
			print "\t\t\t\t<option>03\n";
			print "\t\t\t\t<option>04\n";
			print "\t\t\t\t<option>05\n";
			print "\t\t\t\t<option>06\n";
			print "\t\t\t\t<option>07\n";
			print "\t\t\t\t<option>08\n";
			print "\t\t\t\t<option>09\n";
			print "\t\t\t\t<option>10\n";
			print "\t\t\t\t<option>11\n";
			print "\t\t\t\t<option>12\n";
			print "\t\t\t</select>\n";
			print "\t\t\t: <select name='date[min]' size='1'>\n";
			print "\t\t\t\t<option>00\n";
			print "\t\t\t\t<option>15\n";
			print "\t\t\t\t<option>30\n";
			print "\t\t\t\t<option>45\n";
			print "\t\t\t</select>\n";
			print "\t\t\t<select name='date[am_pm]' size='1'>\n";
			print "\t\t\t\t<option>AM\n";
			print "\t\t\t\t<option>PM\n";
			print "\t\t\t</select>\n";
			print "\t\t</td>\n";
			print "\t</tr>\n";
			print "\t<tr>\n";
			print "\t\t<td>Location:</td>\n";
			print "\t\t<td><input type='text' name='location' size='25' value='$row[location]'></td>\n";
			print "\t</tr>\n";
			print "\t<tr>\n";
			print "\t\t<td>City:</td>\n";
			print "\t\t<td><input type='text' name='city' size='25' value='$row[city]'></td>\n";
			print "\t</tr>\n";
			print "\t<tr>\n";
			print "\t\t<td>Comments:</td>\n";
			print "\t\t<td><textarea name='comments' rows='10' cols='20'>$row[comments]</textarea></td>\n";
			print "\t</tr>\n";
			print "\t<tr>\n";
			print "\t\t<td colspan='2'><input type='submit' value='Save'></td>\n";
			print "\t</tr>\n";
			print "</table>\n";
			print "</form>\n";
		}
	}
	else
	{
		print "<b> ERROR: invalid action </b>\n";
	}
}
else
{
	print "<br><a href='$_SERVER[PHP_SELF]?action=add'>Add New Event</a><br>\n";

	print "<h3>Current Events</h3>\n";

	$sql = "SELECT * FROM events WHERE deleted=0 AND DATE_SUB(CURDATE(),INTERVAL 7 DAY) <= `when` ORDER BY `when` DESC;";
	$result = mysql_query ($sql) or die (mysql_error());

	while ( $row = mysql_fetch_assoc ($result) )
	{
		print "
			<b>$row[when]</b>
			<table border='0' cellpadding='0' cellspacing='2'>
				<tr>
					<td>Location:</td>
					<td>$row[location]</td>
				</tr>
				<tr>
					<td>City:</td>
					<td>$row[city]</td>
				</tr>
				<tr>
					<td>Comments:</td>
					<td>$row[comments]</td>
				</tr>
			</table>
			<a href='$_SERVER[PHP_SELF]?action=edit&id=$row[id]'>Edit Event</a> | <a href='$_SERVER[PHP_SELF]?action=delete&id=$row[id]'>Delete Event</a><br>
			<br>
		";
	}

	print "<br>\n<hr>\n<br>\n";
	print "<h3>Archive Events</h3>\n";

	$sql = "SELECT * FROM events WHERE deleted=0 ORDER BY UNIX_TIMESTAMP('when') DESC;";
	$result = mysql_query ($sql) or die (mysql_error());

	while ( $row = mysql_fetch_assoc ($result) )
	{
	        print "
			<b>$row[when]</b>
			<table border='0' cellpadding='0' cellspacing='2'>
				<tr>
					<td>Location:</td>
					<td>$row[location]</td>
				</tr>
				<tr>
					<td>City:</td>
					<td>$row[city]</td>
				</tr>
				<tr>
					<td>Comments:</td>
					<td>$row[comments]</td>
				</tr>
			</table>
			<a href='$_SERVER[PHP_SELF]?action=edit&id=$row[id]'>Edit Event</a> | <a href='$_SERVER[PHP_SELF]?action=delete&id=$row[id]'>Delete Event</a><br>
			<br>
		";
	}
}

function zeropad($num, $lim)
{
	return (strlen($num) >= $lim) ? $num : zeropad("0" . $num, $lim);
}

?>

</body>
</html>
