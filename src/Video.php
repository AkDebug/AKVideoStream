<?php
namespace Ak\Videostream;

use Ak\Videostream\Traits\SetData;
use Ak\Videostream\Traits\Token;

class Video
{
    use SetData;
    use Token;

    private function openVideo()
    {
        if (filter_var($this->path, FILTER_VALIDATE_URL)) {
            $this->isLink = true;
        }
        if (!($this->stream = fopen($this->path, 'rb'))) {
            die('Could not open stream for reading');
        }
    }

    private function stream()
    {
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

    }

    public function startVideo()
    {
        $this->openVideo();
        $this->setHeader();
        $this->stream();

    }
}