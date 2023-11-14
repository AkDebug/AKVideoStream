<?php

require_once 'vendor/autoload.php';

$video = new \Ak\Videostream\Video();


$file    = "http://localhost/AKVideoStream/test2.mp4";
$headers = get_headers($file, true);
// print_r($headers) ;
$video->setKey("key");
$video->setPath($file);
$video->startVideo();