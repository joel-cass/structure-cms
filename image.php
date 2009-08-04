<?php 
$path = null;
$width = null;
$height = null;

if (array_key_exists("path", $_GET))
	$path = $_GET["path"];
if (array_key_exists("w", $_GET))
	$width = $_GET["w"];
if (array_key_exists("h", $_GET))
	$height = $_GET["h"];

if ($path == null) {
	exit();
}

$ext = preg_replace("/^.*\./","",$path);

$image_path = realpath($path);

switch ($ext) {
	case "gif" :
		$img = imageCreateFromGif($image_path);
		break;
	case "jpeg" || "jpg" :
		$img = imageCreateFromJpeg($image_path);
		break;
	case "png" :
		$img = imageCreateFromPng($image_path);
		break;
	default :
		$img = null;
		break;
}
	
if ($img == null) {
	header("location", $path);
	exit();
} else {
	$orig_width = imageSX($img);
	$orig_height = imageSY($img);
	$image_width = $orig_width;
	$image_height = $orig_height;
	if ($width != null && $height != null) {
		$image_width = min($width, $image_width * ($height / $orig_height));
		$image_height = min($height, $image_height * ($width / $orig_width));
	} elseif ($width != null) {
		$image_height = $orig_height * ($width / $orig_width);
		$image_width = $width;
	} elseif ($height != null) {
		$image_width = $orig_width * ($height / $orig_height);
		$image_height = $height;
	}
	if ($image_width == $orig_width && $image_height == $orig_height) {
		$imgNew = $img;
	} else {
		$imgNew = imageCreateTrueColor($image_width, $image_height);
		imagecopyresampled  ( $imgNew, $img, 0, 0, 0, 0, $image_width, $image_height, imageSX($img), imageSY($img) );
	}
	
}

switch ($ext) {
	case "gif" :
		header('Content-type: image/gif');
		imageGif($imgNew);
		break;
	case "jpeg" || "jpg" :
		header('Content-type: image/jpeg');
		imageJpeg($imgNew);
		break;
	case "png" :
		header('Content-type: image/png');
		imagePng($imgNew);
		break;
}

imageDestroy($img);
imageDestroy($imgNew);

function imageresize_return_bytes($val) {
    $val = trim($val);
    $last = strtolower($val[strlen($val)-1]);
    switch($last) {
        // The 'G' modifier is available since PHP 5.1.0
        case 'g':
            $val *= 1024;
        case 'm':
            $val *= 1024;
        case 'k':
            $val *= 1024;
    }

    return $val;
}

?>