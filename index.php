<?php

// Include the autoloader to load the necessary classes
require_once 'vendor/autoload.php';

// Create a new instance of the Video class from the AKVideoStream library
$video = new \Ak\Videostream\Video();

// Set the encryption key
$video->setKey('395f426c0e5bd914375837483b791d80854dd9a19dd86fd189e94ccade60123');

// Set the initialization vector for encryption
$video->setIV('0000000000001234');

// Set the path to the video file
$video->setPath('test2.mp4');

// Check if a token parameter is present in the URL
if (isset($_GET['token'])) {
    // If a token is present, decrypt the video using the provided token
    $video->Decrypt($_GET['token']);
} else {
    // If no token is present, generate a new token and provide a link with the token in the URL
    echo $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'] . "?token=" . $video->Encrypt();
}
