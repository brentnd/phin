<?php

namespace Phin;

use Illuminate\Mail\Mailable;

class MarkdownMail extends Mailable
{
    public function __construct($template)
    {
        $this->template = $template;
    }

    public function build()
    {
        return $this->markdown($this->template);
    }
}
