<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;

class LunarTimeTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testInvalidDateShouldThrowInvalidArgumentException()
    {
        $date = new \DateTime('1969-07-21 02:56:14');
        $this->expectException(\InvalidArgumentException::class);
        $lstTime = lunar_date('Y-d-C ∇ H:i:S', $date->getTimestamp());
    }

    /**
     * Valid tests - some dates with some formats.
     *
     * @throws \Exception
     */
    public function testSomeValidDatesFromLunarclockDotOrg()
    {
        $format = 'Y-d-C ∇ H:i:S';
        // Get some dates getting from
        $this->assertEquals('01-01-01 ∇ 00:00:00', lunar_date($format, (new \DateTime('1969-07-21 02:56:15'))->getTimestamp()));
        $this->assertEquals('47-11-27 ∇ 20:06:23', lunar_date($format, (new \DateTime('2015-01-23 12:33:00 -0500'))->getTimestamp()));
        $this->assertEquals('47-11-27 ∇ 15:01:36', lunar_date($format, (new \DateTime('2015-01-23 12:33:00'))->getTimestamp()));
        $this->assertEquals('54-09-10 ∇ 12:51:35', lunar_date($format, (new \DateTime('2021-08-24 12:00:00 +0700'))->getTimestamp()));
        $this->assertEquals('54-09-10 ∇ 12:51:35 LST', lunar_date('Y-d-C ∇ H:i:S T', (new \DateTime('2021-08-24 12:00:00 +0700'))->getTimestamp()));
        $this->assertEquals('54-9-10 ∇ 12:51:35', lunar_date('Y-j-C ∇ H:i:S', (new \DateTime('2021-08-24 12:00:00 +0700'))->getTimestamp()));
    }
}
