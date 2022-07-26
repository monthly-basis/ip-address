<?php
namespace MonthlyBasis\IpAddressTest\Model\Service;

use MonthlyBasis\IpAddress\Model\Service as IpAddressService;
use PHPUnit\Framework\TestCase;

class FirstFourSegmentsTest extends TestCase
{
    protected function setUp(): void
    {
        $this->firstFourSegmentsService = new IpAddressService\V6\FirstFourSegments();
    }

    public function test_getFirstFourSegments()
    {
        $ipAddress = '1111:2222:3333:4444:5555:6666:7777:8888';
        $this->assertSame(
            '1111:2222:3333:4444',
            $this->firstFourSegmentsService->getFirstFourSegments($ipAddress)
        );

        /*
         * @todo The service should uncompress the compressed IP address and
         * return 2001:0000:0000:0000
         */
        $ipAddress = '2001::db8:7:8';
        $this->assertSame(
            '2001::db8:7',
            $this->firstFourSegmentsService->getFirstFourSegments($ipAddress)
        );
    }
}
