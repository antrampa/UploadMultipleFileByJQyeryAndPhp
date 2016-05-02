<?php

$uplfr = $_POST['uplfr'];
//$files = $_FILES['file']; //fileselect
$files = $_FILES['fileselect'];
//die(print_r($files));

if(!is_dir($uplfr))
{
    if (!mkdir($uplfr, 7777, true)) {
        die('Failed to create folders...');
    }
}

foreach ($files['error'] as $id => $err)
{
    if ($err == UPLOAD_ERR_OK)
    {
        $fn = $files['name'][$id];
        move_uploaded_file(
            $files['tmp_name'][$id],
            $uplfr. "/" . $fn
        );
        echo "<p>File $fn uploaded.</p>";
    }
}

//foreach ($files as $file)
//{
//    //move_uploaded_file($file['tmp_name'], $uplfr."/" . $file['name']);
//    echo "<p>File ".$file['name']." uploaded.</p>";
//}

//if ($fn)
//{
//
//    // AJAX call
//    //file_put_contents(
//    //	'uploadedocs/' . $fn,
//    //	file_get_contents('php://input')
//    //);
//
//    if(!is_dir($uplfr))
//    {
//        if (!mkdir($uplfr, 7777, true)) {
//            die('Failed to create folders...');
//        }
//    }
//
//    file_put_contents( $uplfr.'/'. $fn, file_get_contents('php://input'));
//
//    echo $fn;
//    echo '/'.$_POST["uplfr"].'/'. $fn;
//    echo '/'.$uplfr.'/'. $fn;
//    exit();
//
//}
//else
//{
//
//    if(!is_dir($uplfr))
//    {
//        if (!mkdir($uplfr, 7777, true)) {
//            die('Failed to create folders...');
//        }
//    }
//
//    //$files = $_FILES['file']; //fileselect
//    $file = $_FILE['filename'];
//    move_uploaded_file($_FILES['filename']['tmp_name'], $uplfr."/" . $_FILES['filename']['name']);
//    echo "<p>File $fn uploaded.</p>";
//
////    foreach ($files['error'] as $id => $err) {
////        if ($err == UPLOAD_ERR_OK) {
////            $fn = $files['name'][$id];
////            move_uploaded_file(
////                $files['tmp_name'][$id],
////                'uploadedocs/'. $uplfr.'/'. $fn
////            );
////            echo "<p>File $fn uploaded.</p>";
////        }
////    }
//}