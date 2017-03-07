<?php

namespace Tests\Podorozhny\DateTime;

use Podorozhny\DateTime\MicroDateTime;

class MicroDateTimeTest extends \PHPUnit_Framework_TestCase
{
    public function testCreateFromFormat()
    {
        $microtime = microtime(true);

        $seconds      = (int) floor($microtime);
        $microSeconds = (int) floor(($microtime - $seconds) * 1000000);

        $time = sprintf('%d.%06d', $seconds, $microSeconds);

        $microDateTime = MicroDateTime::createFromFormat('U.u', $time);

        $this->assertSame($seconds, $microDateTime->getUnixTimeStamp());
        $this->assertSame($microSeconds, $microDateTime->getMicroSeconds());
        $this->assertSame($time, $microDateTime->format('U.u'));
    }

    public function testFormat()
    {
        $microDateTime = MicroDateTime::createFromFormat('U.u', '1488902311.638825');

        $this->assertSame('2017-03-07T15:58:31.638825+0000', $microDateTime->format(MicroDateTime::FORMAT));
    }
}
