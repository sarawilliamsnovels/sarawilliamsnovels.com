<?
session_start();
require_once('settings.php');
$un = ucfirst($_REQUEST['username']);
$err = "";

if($users[$un] == $_REQUEST['password'] && $_REQUEST['username'] != NULL){
	$_SESSION['username'] = $_REQUEST['username'];
	header('location: index.php');
} else if (!empty($_REQUEST['username'])) {
	$err = "invalid username or password<br>";
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title><?= $title; ?> Login</title>
<link href="register.css" rel="stylesheet" type="text/css">
</head>

<body>
<span class="section"><?= $title; ?> Admin Login</span>
<form name="form1" method="post" action="">
<div id="msg"><?=$err;?></div>
  <p>
    

<span class="item">Username</span>
<input name="username" type="text" id="username">
    <br>
    <span class="item">Password</span>
    <input name="password" type="password" id="password">
    <br>
    <input type="submit" name="Submit" value="Submit">
  </p>
</form>
</body>
</html>
