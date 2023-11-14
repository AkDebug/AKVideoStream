<?php
namespace Ak\Videostream;

use Ak\Videostream\Traits\SetData;

class Video
{
    use SetData;

    private function openVideo()
    {
        // if (!filter_var($this->path, FILTER_VALIDATE_URL)) {
            if (!($this->stream = fopen($this->path, 'rb'))) {
                die('Could not open stream for reading');
            }
        // } else {
            $this->isLink = true;
            // $this->stream = file_get_contents($this->path);
        // }
    }

    private function stream()
    {
        // if ($this->isLink) {
            $i = $this->start;
            set_time_limit(0);
            while (!feof($this->stream) && $i <= $this->end) {
                $bytesToRead = $this->buffer;
                if (($i + $bytesToRead) > $this->end) {
                    $bytesToRead = $this->end - $i + 1;
                }
                $data = fread($this->stream, $bytesToRead);
                echo $data;
                flush();
                $i += $bytesToRead;
            }
            fclose($this->stream);
            exit;
        // } else {
        //     echo $this->stream;
        //     flush();
        //     exit;
        // }
    }

    public function startVideo()
    {
        $this->openVideo();
        $this->setHeader();
        $this->stream();

    }
}