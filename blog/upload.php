<?
$folder = "files/"; //where to put the uploaded files
$tmpname = $_FILES['podcast']['tmp_name'];
$filename = "";
$podcast = "";
if (!empty($tmpname) && file_exists($tmpname)) {
	//check for existing file and delete it
	if (!empty($_POST['storedpodcast'])) {
		$basename = basename($_POST['storedpodcast']);
		unlink($folder.$basename);
	}
	//process new file
	$filename = time() .'.mp3';
	if(!move_uploaded_file($tmpname, $folder.$filename)){ // Upload file
		print "File upload error."; // Display error
	}
	//set new podcast url
	$podcast = "http://".$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF'])."/".$folder.$filename;
	$_POST['podcast'] = $podcast;
	$_REQUEST['podcast'] = $podcast;
}

?>