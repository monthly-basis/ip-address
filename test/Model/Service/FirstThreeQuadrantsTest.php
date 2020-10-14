<?php
namespace LeoGalleguillos\IpAddressTest\Model\Service;

use LeoGalleguillos\IpAddress\Model\Service as IpAddressService;
use PHPUnit\Framework\TestCase;

class FirstThreeQuadrantsTest extends TestCase
{
    protected function setUp(): void
    {
        $this->firstThreeQuadrantsService = new IpAddressService\FirstThreeQuadrants();
    }

    public function testGetFirstThreeQuadrants()
    {
        $this->assertSame(
            '1.2.3',
            $this->firstThreeQuadrantsService->getFirstThreeQuadrants(
                '1.2.3.4'
            )
        );

        $this->assertSame(
            '123.456.789',
            $this->firstThreeQuadrantsService->getFirstThreeQuadrants(
                '123.456.789.0'
            )
        );

        $this->assertSame(
            '255.255.1',
            $this->firstThreeQuadrantsService->getFirstThreeQuadrants(
                '255.255.1.1'
            )
        );
    }
}
