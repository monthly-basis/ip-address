<?php
namespace MonthlyBasis\IpAddressTest\Model\Service\V4;

use Laminas\Db\Adapter\Driver\Pdo\Result;
use MonthlyBasis\IpAddress\Model\Service as IpAddressService;
use MonthlyBasis\IpAddress\Model\Table as IpAddressTable;
use MonthlyBasis\LaminasTest\Hydrator\CountableIterator;
use PHPUnit\Framework\TestCase;

class BannedFirstThreeQuadrantsTest extends TestCase
{
    protected function setUp(): void
    {
        $this->bannedFirstThreeQuadrantsTableMock = $this->createMock(
            IpAddressTable\BannedFirstThreeQuadrants::class
        );

        $this->bannedFirstThreeQuadrantsService = new IpAddressService\V4\BannedFirstThreeQuadrants(
            $this->bannedFirstThreeQuadrantsTableMock
        );
    }

    public function test_getBannedFirstThreeQuadrants()
    {
        $resultMock = $this->createMock(
            Result::class
        );
        $hydrator = new CountableIterator();
        $hydrator->hydrate(
            $resultMock,
            [
                [
                    'first_three_quadrants' => '1.2.3',
                    'created' => '2022-07-27 22:52:04',
                ],
                [
                    'first_three_quadrants' => '4.5.6',
                    'created' => '2022-07-28 22:52:04',
                ],
            ]
        );
        $this->bannedFirstThreeQuadrantsTableMock
            ->expects($this->once())
            ->method('select')
            ->willReturn($resultMock)
            ;

        $generator = $this->bannedFirstThreeQuadrantsService->getBannedFirstThreeQuadrants();
        $this->assertSame(
            [
                [
                    'first_three_quadrants' => '1.2.3',
                    'created' => '2022-07-27 22:52:04',
                ],
                [
                    'first_three_quadrants' => '4.5.6',
                    'created' => '2022-07-28 22:52:04',
                ],
            ],
            iterator_to_array($generator)
        );
    }
}
