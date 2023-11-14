<?php

require_once 'vendor/autoload.php';

$video = new \Ak\Videostream\Video();

$video->setSubject('hiiii');
echo $video->subject;