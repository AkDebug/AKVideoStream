<?php

require_once 'vendor/autoload.php';

$video = new \Ak\Videostream\Video();


$file    = "http://commondatastorage.googleapis.com/gtv-videos-bucket/sample/BigBuckBunny.mp4";
// $headers = get_headers($file, true);
// print_r($headers);

// $video->setPath($file);
// $video->startVideo();

$file = file_get_contents($file);
echo filesize($file);