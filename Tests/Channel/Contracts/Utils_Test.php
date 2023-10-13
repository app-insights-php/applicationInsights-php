<?php declare(strict_types=1);
namespace ApplicationInsights\Channel\Contracts;

use PHPUnit\Framework\TestCase;

/**
 * Contains tests for Utils class.
 */
class Utils_Test extends TestCase
{
    public function testConvertMillisecondsToTimeSpan() : void
    {
        $this->assertEquals(Utils::convertMillisecondsToTimeSpan(0), '00:00:00.000');
        $this->assertEquals(Utils::convertMillisecondsToTimeSpan(1), '00:00:00.001', 'milliseconds digit 1');
        $this->assertEquals(Utils::convertMillisecondsToTimeSpan(10), '00:00:00.010', 'milliseconds digit 2');
        $this->assertEquals(Utils::convertMillisecondsToTimeSpan(100), '00:00:00.100', 'milliseconds digit 3');
        $this->assertEquals(Utils::convertMillisecondsToTimeSpan(1 * 1000), '00:00:01.000', 'seconds digit 1');
        $this->assertEquals(Utils::convertMillisecondsToTimeSpan(10 * 1000), '00:00:10.000', 'seconds digit 2');
        $this->assertEquals(Utils::convertMillisecondsToTimeSpan(1 * 60 * 1000), '00:01:00.000', 'minutes digit 1');
        $this->assertEquals(Utils::convertMillisecondsToTimeSpan(10 * 60 * 1000), '00:10:00.000', 'minutes digit 2');
        $this->assertEquals(Utils::convertMillisecondsToTimeSpan(1 * 60 * 60 * 1000), '01:00:00.000', 'hours digit 1');
        $this->assertEquals(Utils::convertMillisecondsToTimeSpan(10 * 60 * 60 * 1000), '10:00:00.000', 'hours digit 2');
        $this->assertEquals(Utils::convertMillisecondsToTimeSpan(24 * 60 * 60 * 1000), '00:00:00.000', 'hours overflow');
        $this->assertEquals(Utils::convertMillisecondsToTimeSpan(11 * 3600000 + 11 * 60000 + 11111), '11:11:11.111', 'all digits');

        $this->assertEquals(Utils::convertMillisecondsToTimeSpan(''), '00:00:00.000', 'invalid input');
        $this->assertEquals(Utils::convertMillisecondsToTimeSpan("'"), '00:00:00.000', 'invalid input');
        $this->assertEquals(Utils::convertMillisecondsToTimeSpan(null), '00:00:00.000', 'invalid input');
        $this->assertEquals(Utils::convertMillisecondsToTimeSpan([]), '00:00:00.000', 'invalid input');
        $this->assertEquals(Utils::convertMillisecondsToTimeSpan(-1), '00:00:00.000', 'invalid input');
    }

    public function testReturnISOStringForTime() : void
    {
        $this->assertEquals('1970-01-01T00:00:01.000000Z', Utils::returnISOStringForTime(1));
        $this->assertEquals('1970-01-01T00:00:01.000000Z', Utils::returnISOStringForTime(1.000000));
        $this->assertEquals('1970-01-01T00:00:01.100000Z', Utils::returnISOStringForTime(1.1));
        $this->assertEquals('1970-01-01T00:00:01.010000Z', Utils::returnISOStringForTime(1.01));
        $this->assertEquals('1970-01-01T00:00:01.001000Z', Utils::returnISOStringForTime(1.001));
        $this->assertEquals('1970-01-01T00:00:01.000100Z', Utils::returnISOStringForTime(1.0001));
        $this->assertEquals('1970-01-01T00:00:01.000010Z', Utils::returnISOStringForTime(1.00001));
        $this->assertEquals('1970-01-01T00:00:01.000001Z', Utils::returnISOStringForTime(1.000001));
        $this->assertEquals('1970-01-01T00:00:01.000000Z', Utils::returnISOStringForTime(1.0000001), 'truncate to 6 decimal places');
        $this->assertEquals('1970-01-01T00:00:00.999999Z', Utils::returnISOStringForTime(0.999999));
        $this->assertEquals('1970-01-01T00:00:00.999999Z', Utils::returnISOStringForTime(0.9999994), 'rounds down to 6 decimal places');
        $this->assertEquals('1970-01-01T00:00:00.999999Z', Utils::returnISOStringForTime(0.9999985), 'rounds up to 6 decimal places');
        $this->assertEquals('1970-01-01T00:00:01.000000Z', Utils::returnISOStringForTime(0.9999995), 'rounds up to 6 decimal places');
        $this->assertEquals('1970-01-01T00:00:11.123456Z', Utils::returnISOStringForTime(11.123456));
        $this->assertEquals('2023-10-05T17:49:53.000000Z', Utils::returnISOStringForTime(1696528193));
        $this->assertEquals('2023-10-05T17:49:53.999999Z', Utils::returnISOStringForTime(1696528193.999999));
    }

    public function testReturnISOStringForTime_nullInput() : void
    {
        // Make sure that the current time is used if null is passed in.
        // We can't know exactly what microtime() will return, so instead we'll just make sure that
        // the returned time is within 1 second of the current time.

        $curTime = \microtime(true);
        $time = Utils::returnISOStringForTime();
        $this->assertTrue(\strtotime($time) < $curTime + 1.0, "Failed when time={$time} and {$curTime}={$curTime}");

        $curTime = \microtime(true);
        $time = Utils::returnISOStringForTime(null);
        $this->assertTrue(\strtotime($time) < $curTime + 1.0, "Failed when time={$time} and {$curTime}={$curTime}");
    }
}
