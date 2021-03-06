<?php
namespace MonthlyBasis\IpAddressTest\Model\Service;

use MonthlyBasis\IpAddress\Model\Service as IpAddressService;
use MonthlyBasis\IpAddress\Model\Table as IpAddressTable;
use PHPUnit\Framework\TestCase;

class BanAndConditionallyBanFirstThreeQuadrantsTest extends TestCase
{
    protected function setUp(): void
    {
        $this->banServiceMock = $this->createMock(
            IpAddressService\Ban::class
        );
        $this->banFirstThreeQuadrantsServiceMock = $this->createMock(
            IpAddressService\BanFirstThreeQuadrants::class
        );
        $this->firstThreeQuadrantsServiceMock = $this->createMock(
            IpAddressService\FirstThreeQuadrants::class
        );
        $this->bannedTableMock = $this->createMock(
            IpAddressTable\Banned::class
        );
        $this->banAndConditionallyBanFirstThreeQuadrantsService = new IpAddressService\BanAndConditionallyBanFirstThreeQuadrants(
            $this->banServiceMock,
            $this->banFirstThreeQuadrantsServiceMock,
            $this->firstThreeQuadrantsServiceMock,
            $this->bannedTableMock
        );
    }

    public function testBanAndConditionallyBanFirstThreeQuadrants()
    {
        $this->banFirstThreeQuadrantsServiceMock
            ->expects($this->exactly(0))
            ->method('banFirstThreeQuadrants');

        $this->banAndConditionallyBanFirstThreeQuadrantsService
            ->banAndConditionallyBanFirstThreeQuadrants(
            '1.2.3.4',
            0,
            'reason'
        );
    }
}
