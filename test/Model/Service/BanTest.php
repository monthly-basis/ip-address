<?php
namespace MonthlyBasis\IpAddressTest\Model\Service;

use MonthlyBasis\IpAddress\Model\Service as IpAddressService;
use MonthlyBasis\IpAddress\Model\Table as IpAddressTable;
use PHPUnit\Framework\TestCase;

class BanTest extends TestCase
{
    protected function setUp(): void
    {
        $this->bannedTableMock = $this->createMock(
            IpAddressTable\Banned::class
        );
        $this->banService = new IpAddressService\Ban(
            $this->bannedTableMock
        );
    }

    public function testBan()
    {
        $this->bannedTableMock->method('insert')->will(
            $this->onConsecutiveCalls(
                1, 2, 0
            )
        );
        $this->assertTrue(
            $this->banService->ban('1.2.3.4', 0, 'reason')
        );
        $this->assertTrue(
            $this->banService->ban('1.2.3.4', 0, 'reason')
        );
        $this->assertFalse(
            $this->banService->ban('1.2.3.4', 0, 'reason')
        );
    }
}
