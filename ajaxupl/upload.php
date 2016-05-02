<?php
/*
Server-side PHP file upload code for HTML5 File Drag & Drop demonstration
Featured on SitePoint.com
Developed by Craig Buckler (@craigbuckler) of OptimalWorks.net
*/
$fn = (isset($_SERVER['HTTP_X_FILENAME']) ? $_SERVER['HTTP_X_FILENAME'] : false);
//$postdata = file_get_contents('php://input');
//die(var_dump($postdata));
$uplfr2 = $_POST['uplfr'];
$uplfr = $_POST['X_UPLFR'];//(isset($_SERVER['uplfr']) ? $_SERVER['uplfr'] : false);
echo "uplfr:" . $uplfr;
echo "<br>uplfr2:" . $uplfr2;
die("<br>uplfr:" . $uplfr);
if ($fn) {

	// AJAX call
	//file_put_contents(
	//	'uploadedocs/' . $fn,
	//	file_get_contents('php://input')
	//);
	
	if(!is_dir($uplfr))
	{
		if (!mkdir($uplfr, 7777, true)) {
			die('Failed to create folders...');
		}
	}
	
	file_put_contents( $uplfr.'/'. $fn, file_get_contents('php://input'));
	
	echo $fn;
    echo '/'.$_POST["uplfr"].'/'. $fn;
    echo '/'.$uplfr.'/'. $fn;
	exit();

}
else {

	// form submit
	$files = $_FILES['fileselect'];

	if(!is_dir($uplfr))
	{
		if (!mkdir($uplfr, 7777, true)) {
			die('Failed to create folders...');
		}
	}
	
	foreach ($files['error'] as $id => $err) {
		if ($err == UPLOAD_ERR_OK) {
			$fn = $files['name'][$id];
			move_uploaded_file(
				$files['tmp_name'][$id],
				'uploadedocs/'. $uplfr.'/'. $fn
			);
			echo "<p>File $fn uploaded.</p>";
		}
	}

}