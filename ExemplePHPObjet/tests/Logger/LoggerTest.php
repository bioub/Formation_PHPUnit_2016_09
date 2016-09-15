<?php

namespace SmalsTest\Logger;


use PHPUnit\Framework\TestCase;
use Prophecy\Argument;
use Smals\Logger\Logger;
use Smals\Writer\FileWriter;
use SmalsTest\Writer\FakeWriter;

class LoggerTest extends TestCase
{
    const LOG_FILE = PROJECT_PATH . '/logs/test.log';

    public function testLogIntegration() {
        $writer = new FileWriter(self::LOG_FILE);
        $logger = new Logger($writer);

        $logger->log('notice', 'Un message');

        $content = file_get_contents(self::LOG_FILE);

        $regexp = '/\[notice\] - \d{4}-\d{2}-\d{2} \d{2}:\d{2}:\d{2} - Un message\n/';
        $this->assertRegExp($regexp, $content);
        unlink(self::LOG_FILE);
    }

    public function testLogAvecFake() {
        $fakeWriter = new FakeWriter();
        $logger = new Logger($fakeWriter);

        $logger->log('notice', 'Un message');
        $regexp = '/\[notice\] - \d{4}-\d{2}-\d{2} \d{2}:\d{2}:\d{2} - Un message\n/';
        $this->assertRegExp($regexp, $fakeWriter->getMessages()[0]);
    }

    public function testLogAvecMock() {

        $mock = $this->getMockBuilder(FileWriter::class)
                     ->disableOriginalConstructor()
                     ->getMock();

        $mock->expects($this->once())
            ->method('write');

        $logger = new Logger($mock);
        $logger->log('notice', 'Un message');
    }

    public function testLogAvecMockAvecProphecy() {

        $mock = $this->prophesize(FileWriter::class);
        $mock->write(Argument::type('string'))->shouldBeCalledTimes(1);

        $logger = new Logger($mock->reveal());
        $logger->log('notice', 'Un message');
    }
}