<?php
namespace MonthlyBasis\IpAddressTest\Model\Service\V6;

use Laminas\Db\Adapter\Driver\Pdo\Result;
use MonthlyBasis\IpAddress\Model\Service as IpAddressService;
use MonthlyBasis\IpAddress\Model\Table as IpAddressTable;
use MonthlyBasis\LaminasTest\Hydrator\CountableIterator;
use PHPUnit\Framework\TestCase;

class BannedFirstFourSegmentsTest extends TestCase
{
    protected function setUp(): void
    {
        $this->bannedFirstFourSegmentsTableMock = $this->createMock(
            IpAddressTable\BannedFirstFourSegments::class
        );

        $this->bannedFirstFourSegmentsService = new IpAddressService\V6\BannedFirstFourSegments(
            $this->bannedFirstFourSegmentsTableMock
        );
    }

    public function test_getBannedFirstFourSegments()
    {
        $resultMock = $this->createMock(
            Result::class
        );
        $hydrator = new CountableIterator();
        $hydrator->hydrate(
            $resultMock,
            [
                [
                    'first_four_segments' => '1111:2222:3333:4444',
                    'created' => '2022-07-27 22:52:04',
                ],
                [
                    'first_four_segments' => 'aaaa:bbbb:cccc:dddd',
                    'created' => '2022-07-28 22:52:04',
                ],
            ]
        );
        $this->bannedFirstFourSegmentsTableMock
            ->expects($this->once())
            ->method('select')
            ->willReturn($resultMock)
            ;

        $generator = $this->bannedFirstFourSegmentsService->getBannedFirstFourSegments();
        $this->assertSame(
            [
                [
                    'first_four_segments' => '1111:2222:3333:4444',
                    'created' => '2022-07-27 22:52:04',
                ],
                [
                    'first_four_segments' => 'aaaa:bbbb:cccc:dddd',
                    'created' => '2022-07-28 22:52:04',
                ],
            ],
            iterator_to_array($generator)
        );
    }
}
