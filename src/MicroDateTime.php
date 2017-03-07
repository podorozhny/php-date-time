<?php

namespace Podorozhny\DateTime;

class MicroDateTime extends \DateTime
{
    const FORMAT = 'Y-m-d\TH:i:s.uO';

    /**
     * @param string             $time
     * @param \DateTimeZone|null $timezone
     */
    public function __construct($time = 'now', \DateTimeZone $timezone = null)
    {
        if ($time === 'now') {
            $microtime = microtime(true);

            $seconds      = (int) floor($microtime);
            $microSeconds = (int) floor(($microtime - $seconds) * 1000000);

            $time = sprintf('%d.%06d', $seconds, $microSeconds);

            $dateTime = \DateTime::createFromFormat('U.u', $time);

            $time = $dateTime->format(self::FORMAT);
        }

        parent::__construct($time, $timezone);
    }

    /**
     * @inheritdoc
     */
    public static function createFromFormat($format, $time, $timezone = null)
    {
        $dateTime = parent::createFromFormat($format, $time, $timezone);

        return new MicroDateTime($dateTime->format(self::FORMAT));
    }

    /**
     * @return int
     */
    public function getUnixTimeStamp()
    {
        return (int) $this->format('U');
    }

    /**
     * @return int
     */
    public function getMicroSeconds()
    {
        return (int) $this->format('u');
    }
}
