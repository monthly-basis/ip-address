<?php
namespace MonthlyBasis\IpAddressTest\Model\Service;

use MonthlyBasis\IpAddress\Model\Service as IpAddressService;
use MonthlyBasis\IpAddress\Model\Table as IpAddressTable;
use PHPUnit\Framework\TestCase;

class BanFirstThreeQuadrantsTest extends TestCase
{
    protected function setUp(): void
    {
        $this->bannedFirstThreeQuadrantsTableMock = $this->createMock(
            IpAddressTable\BannedFirstThreeQuadrants::class
        );
        $this->banFirstThreeQuadrantsService = new IpAddressService\BanFirstThreeQuadrants(
            $this->bannedFirstThreeQuadrantsTableMock
        );
    }

    public function test_banFirstThreeQuadrants()
    {
        $this->bannedFirstThreeQuadrantsTableMock
             ->expects($this->exactly(3))
             ->method('insertIgnore')
             ->withConsecutive(
                 ['1.2.3'],
                 ['4.5.6'],
                 ['7.8.9'],
             )
             ->will(
                 $this->onConsecutiveCalls(
                     1, 2, 0
                 )
        );
        $this->assertTrue(
            $this->banFirstThreeQuadrantsService->banFirstThreeQuadrants('1.2.3')
        );
        $this->assertTrue(
            $this->banFirstThreeQuadrantsService->banFirstThreeQuadrants('4.5.6')
        );
        $this->assertFalse(
            $this->banFirstThreeQuadrantsService->banFirstThreeQuadrants('7.8.9')
        );
    }
}
