<?php

require_once 'vendor/autoload.php';

$video = new \Ak\Videostream\Video();
$video->setKey('395f426c0e5bd914375837483b791d80854dd9a19dd86fd189e94ccade60123');
$video->setIV('0000000000001234');
$video->setPath('test2.mp4');
if (isset($_GET['token'])) {
    // $video->Decrypt($_GET['token']);
     $video->Decrypt($_GET['token']);
} else {
    echo $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'] . "?token=" . $video->Encrypt();
}