<?php 
$path = null;
$width = null;
$height = null;

require_once "classes/includes/paths.php";

if (array_key_exists("path", $_GET))
	$path = $_GET["path"];
if (array_key_exists("w", $_GET) && is_numeric($_GET["w"]))
	$width = $_GET["w"];
if (array_key_exists("h", $_GET) && is_numeric($_GET["h"]))
	$height = $_GET["h"];

if ($path == null) {
	exit();
} elseif ($width == null && $height == null) {
	header("location: $path");
	exit();
}

$ext = strToLower(preg_replace("/^.*\./","",$path));

$image_path = realpath($path);

$cache_name = "path=".$path.";w=".$width.";h=;".$height;
$cache_file = md5($cache_name) . "." . $ext;
$cache_folder_path = getRootPath() . "/" . "_image_cache/";
$cache_folder_url = getRootURL() . "/" . "_image_cache/";
$cache_path = $cache_folder_path . $cache_file;
$cache_url = $cache_folder_url . $cache_file;

if (file_exists($cache_path)) {
	switch ($ext) {
		case "gif" :
			header('Content-type: image/gif');
			$cache = imageCreateFromGif($cache_path);
			imageGif($cache);
			break;
		case "jpg" :
			header('Content-type: image/jpeg');
			$cache = imageCreateFromJpeg($cache_path);
			imageJpeg($cache);
			break;
		case "jpeg" :
			header('Content-type: image/jpeg');
			$cache = imageCreateFromJpeg($cache_path);
			imageJpeg($cache);
			break;
		case "png" :
			header('Content-type: image/png');
			$cache = imageCreateFromPng($cache_path);
			imagePng($cache);
			break;
	}
	exit();	
}

if (!file_exists($image_path)) {
	//header("location: $path");
	exit();
}

switch ($ext) {
	case "gif" :
		$img = imageCreateFromGif($image_path);
		break;
	case "jpg" :
		$img = imageCreateFromJpeg($image_path);
		break;
	case "jpeg" :
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
	header("location: $path");
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

if (!file_exists($cache_folder_path)) {
	mkdir($cache_folder_path);
} 

switch ($ext) {
	case "gif" :
		header('Content-type: image/gif');
		imageGif($imgNew, $cache_path);
		imageGif($imgNew);
		break;
	case "jpg" :
		header('Content-type: image/jpeg');
		imageJpeg($imgNew, $cache_path);
		imageJpeg($imgNew);
		break;
	case "jpeg" :
		header('Content-type: image/jpeg');
		imageJpeg($imgNew, $cache_path);
		imageJpeg($imgNew);
		break;
	case "png" :
		header('Content-type: image/png');
		imagePng($imgNew, $cache_path);
		imagePng($imgNew);
		break;
}

imageDestroy($img);
imageDestroy($imgNew);

// function from docos to convert short-hand notation to bytes
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