<?php
namespace LeoGalleguillos\IpAddressTest\Model\Service;

use LeoGalleguillos\IpAddress\Model\Service as IpAddressService;
use LeoGalleguillos\IpAddress\Model\Table as IpAddressTable;
use PHPUnit\Framework\TestCase;

class BannedTest extends TestCase
{
    protected function setUp()
    {
        $this->bannedTableMock = $this->createMock(
            IpAddressTable\Banned::class
        );
        $this->ipAddressService = new IpAddressService\Banned(
            $this->bannedTableMock
        );
    }

    public function testIsBanned()
    {
        $this->bannedTableMock->method('selectWhereIpAddress')->will(
            $this->onConsecutiveCalls(
                function () {throw new TypeError();},
                []
            )
        );

        $this->assertFalse(
            $this->ipAddressService->isBanned('1.2.3.4')
        );

        $this->assertTrue(
            $this->ipAddressService->isBanned('5.6.7.8')
        );
    }
}
