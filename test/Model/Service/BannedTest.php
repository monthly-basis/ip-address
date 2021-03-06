<?php
namespace MonthlyBasis\IpAddressTest\Model\Service;

use MonthlyBasis\IpAddress\Model\Service as IpAddressService;
use MonthlyBasis\IpAddress\Model\Table as IpAddressTable;
use PHPUnit\Framework\TestCase;

class BannedTest extends TestCase
{
    protected function setUp(): void
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
