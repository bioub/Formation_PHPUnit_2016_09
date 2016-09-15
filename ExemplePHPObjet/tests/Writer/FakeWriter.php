<?php
namespace SmalsTest\Writer;

use Smals\Writer\WriterInterface;

class FakeWriter implements WriterInterface
{
    /**
     * @var string[]
     */
    protected $messages = [];

    public function write($message)
    {
        $this->messages[] = "$message\n";
    }

    /**
     * @return string[]
     */
    public function getMessages()
    {
        return $this->messages;
    }


}