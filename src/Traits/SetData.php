<?php
namespace Ak\Videostream\Traits;

trait SetData
{
    // Path to the video file or link
    private $path;

    // Flag to indicate if the path is a link
    public $isLink = false;

    // Link for the video (if it's a link)
    public $link;

    // Stream and buffer properties for video streaming
    public $stream = "";
    // Speed Send Video To Browser
    private $buffer = 102400;
    public $start = -1;
    public $end = -1;
    public $size = 0;

    // Method to set the path for the video
    public function setPath($path)
    {
        $this->path = $path;
        return $this;
    }

    // Method to set the HTTP headers for video streaming
    public function setHeader()
    {
        // Clear output buffer
        ob_get_clean();

        // Set Content-Type to video/mp4
        header("Content-Type: video/mp4");

        // Set cache control, expiration, and other headers
        header("Cache-Control: max-age=2592000, public");
        header("Expires: " . gmdate('D, d M Y H:i:s', time() + 2592000) . ' GMT');

        // Uncomment the next line if Last-Modified header is needed
        header("Last-Modified: " . gmdate('D, d M Y H:i:s', @filemtime($this->path)) . ' GMT');

        // Initialize start, size, and end properties
        $this->start = 0;
        $this->size  = $this->isLink ? get_headers($this->path, true)['Content-Length'] : filesize($this->path);
        $this->end   = $this->size - 1;

        // Set Accept-Ranges header
        header("Accept-Ranges: 0-" . $this->end);

        // Handle HTTP Range requests
        if (isset($_SERVER['HTTP_RANGE'])) {

            $c_start = $this->start;
            $c_end   = $this->end;

            // Parse the range header
            list(, $range) = explode('=', $_SERVER['HTTP_RANGE'], 2);

            // Handle cases where multiple ranges are requested
            if (strpos($range, ',') !== false) {
                header('HTTP/1.1 416 Requested Range Not Satisfiable');
                header("Content-Range: bytes $this->start-$this->end/$this->size");
                exit;
            }

            // Handle cases where range starts with '-'
            if ($range == '-') {
                $c_start = $this->size - substr($range, 1);
            } else {
                $range   = explode('-', $range);
                $c_start = $range[0];

                $c_end = (isset($range[1]) && is_numeric($range[1])) ? $range[1] : $c_end;
            }

            // Ensure valid range values
            $c_end = ($c_end > $this->end) ? $this->end : $c_end;
            if ($c_start > $c_end || $c_start > $this->size - 1 || $c_end >= $this->size) {
                header('HTTP/1.1 416 Requested Range Not Satisfiable');
                header("Content-Range: bytes $this->start-$this->end/$this->size");
                exit;
            }

            // Update start, end, and length properties
            $this->start = $c_start;
            $this->end   = $c_end;
            $length      = $this->end - $this->start + 1;

            // Move the file pointer to the requested position
            fseek($this->stream, $this->start);

            // Set headers for partial content
            header('HTTP/1.1 206 Partial Content');
            header("Content-Length: " . $length);
            header("Content-Range: bytes $this->start-$this->end/" . $this->size);
        } else {
            // Set Content-Length for the full content if no range is requested
            header("Content-Length: " . $this->size);
        }
    }
}
?>
