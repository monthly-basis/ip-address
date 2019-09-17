<?php
namespace LeoGalleguillos\IpAddressTest\Model\Service;

use LeoGalleguillos\IpAddress\Model\Service as IpAddressService;
use LeoGalleguillos\IpAddress\Model\Table as IpAddressTable;
use PHPUnit\Framework\TestCase;

class BanFirstThreeQuadrantsTest extends TestCase
{
    protected function setUp()
    {
        $this->bannedFirstThreeQuadrantsTableMock = $this->createMock(
            IpAddressTable\BannedFirstThreeQuadrants::class
        );
        $this->banFirstThreeQuadrantsService = new IpAddressService\BanFirstThreeQuadrants(
            $this->bannedFirstThreeQuadrantsTableMock
        );
    }

    public function testBan()
    {
        $this->bannedFirstThreeQuadrantsTableMock->method('insert')->will(
            $this->onConsecutiveCalls(
                1, 2, 0
            )
        );
        $this->assertTrue(
            $this->banFirstThreeQuadrantsService->banFirstThreeQuadrants('1.2.3.4')
        );
        $this->assertTrue(
            $this->banFirstThreeQuadrantsService->banFirstThreeQuadrants('1.2.3.4')
        );
        $this->assertFalse(
            $this->banFirstThreeQuadrantsService->banFirstThreeQuadrants('1.2.3.4')
        );
    }
}
