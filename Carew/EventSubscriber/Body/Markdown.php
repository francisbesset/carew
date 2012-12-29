<?php

namespace Carew\EventSubscriber\Body;

use Carew\EventSubscriber\EventSubscriber;
use dflydev\markdown\MarkdownParser;

class Markdown extends EventSubscriber
{
    private $markdownParser;

    public function __construct($markdownParser = null)
    {
        $this->markdownParser = $markdownParser ?: new MarkdownParser();
    }

    public function onDocumentProcess($event)
    {
        $subject = $event->getSubject();

        $subject['body'] = $this->markdownParser->transformMarkdown($subject['body']);

        $event->setSubject($subject);
    }

    public static function getPriority()
    {
        return 256;
    }
}
