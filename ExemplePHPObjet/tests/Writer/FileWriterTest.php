<?php

namespace SmalsTest\Writer;

use PHPUnit\Framework\TestCase;
use Smals\Writer\FileWriter;

class FileWriterTest extends TestCase
{
    /**
     * @var FileWriter
     */
    protected $fw;

    const LOG_FILE = PROJECT_PATH . '/logs/test.log';

    protected function setUp()
    {
        $this->fw = new FileWriter(self::LOG_FILE);
    }

    public function testWrite()
    {
        $this->fw->write('Hello');
        $this->assertStringEqualsFile(self::LOG_FILE, "Hello\n");
    }

    protected function tearDown()
    {
        $this->fw = null;
        unlink(self::LOG_FILE);
    }
}