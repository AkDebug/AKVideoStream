<?php
namespace Ak\Videostream\Traits;

trait SetData
{
    public $subject;
    public function setSubject($subject)
    {
        $this->subject = $subject;
        return $this;
    }
}