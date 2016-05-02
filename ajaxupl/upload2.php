<?php
/*
Server-side PHP file upload code for HTML5 File Drag & Drop demonstration
Featured on SitePoint.com
Developed by Craig Buckler (@craigbuckler) of OptimalWorks.net
*/
$fn = (isset($_SERVER['HTTP_X_FILENAME']) ? $_SERVER['HTTP_X_FILENAME'] : false);
//$postdata = file_get_contents('php://input');
//die(var_dump($postdata));
$uplfr = $_POST['uplfr'];
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
			 $uplfr.'/'. $fn
		);
		echo "<p>File $fn uploaded.</p>";
	}
}