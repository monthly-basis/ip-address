<?php
namespace MonthlyBasis\IpAddressTest\Model\Service;

use Laminas\Db\Adapter\Driver\Pdo\Result;
use MonthlyBasis\IpAddress\Model\Service as IpAddressService;
use MonthlyBasis\IpAddress\Model\Table as IpAddressTable;
use MonthlyBasis\LaminasTest\Hydrator\CountableIterator;
use PHPUnit\Framework\TestCase;

class BannedTest extends TestCase
{
    protected function setUp(): void
    {
        $this->firstThreeQuadrantsBannedServiceMock = $this->createMock(
            IpAddressService\FirstThreeQuadrantsBanned::class
        );
        $this->firstFourSegmentsBannedServiceMock = $this->createMock(
            IpAddressService\V6\FirstFourSegmentsBanned::class
        );
        $this->versionServiceMock = $this->createMock(
            IpAddressService\Version::class
        );
        $this->bannedTableMock = $this->createMock(
            IpAddressTable\Banned::class
        );

        $this->ipAddressService = new IpAddressService\Banned(
            $this->firstThreeQuadrantsBannedServiceMock,
            $this->firstFourSegmentsBannedServiceMock,
            $this->versionServiceMock,
            $this->bannedTableMock,
        );
    }

    public function test_isBanned_ipIsBanned_true()
    {
        $resultMock = $this->createMock(
            Result::class
        );
        $hydrator = new CountableIterator();
        $hydrator->hydrate(
            $resultMock,
            [
                'ip_address' => '1.2.3.4',
                'created' => '2022-07-28 22:52:04',
            ]
        );
        $this->bannedTableMock
            ->expects($this->once())
            ->method('selectWhereIpAddress')
            ->with('1.2.3.4')
            ->willReturn($resultMock)
            ;
        $this->versionServiceMock
            ->expects($this->exactly(0))
            ->method('getVersion')
            ;
        $this->firstThreeQuadrantsBannedServiceMock
            ->expects($this->exactly(0))
            ->method('areFirstThreeQuadrantsBanned')
            ;
        $this->firstFourSegmentsBannedServiceMock
            ->expects($this->exactly(0))
            ->method('areFirstFourSegmentsBanned')
            ;

        $this->assertTrue(
            $this->ipAddressService->isBanned('1.2.3.4')
        );
    }

    public function test_isBanned_firstThreeQuadrantsAreBanned_true()
    {
        $resultMock = $this->createMock(
            Result::class
        );
        $hydrator = new CountableIterator();
        $hydrator->hydrate(
            $resultMock,
            []
        );
        $this->bannedTableMock
            ->expects($this->once())
            ->method('selectWhereIpAddress')
            ->with('1.2.3.4')
            ->willReturn($resultMock)
            ;
        $this->versionServiceMock
            ->expects($this->once())
            ->method('getVersion')
            ->with('1.2.3.4')
            ->willReturn(4)
            ;
        $this->firstThreeQuadrantsBannedServiceMock
            ->expects($this->once())
            ->method('areFirstThreeQuadrantsBanned')
            ->with('1.2.3.4')
            ->willReturn(true)
            ;
        $this->firstFourSegmentsBannedServiceMock
            ->expects($this->exactly(0))
            ->method('areFirstFourSegmentsBanned')
            ;

        $this->assertTrue(
            $this->ipAddressService->isBanned('1.2.3.4')
        );
    }

    public function test_isBanned_firstFourSegmentsAreBanned_true()
    {
        $resultMock = $this->createMock(
            Result::class
        );
        $hydrator = new CountableIterator();
        $hydrator->hydrate(
            $resultMock,
            []
        );
        $this->bannedTableMock
            ->expects($this->once())
            ->method('selectWhereIpAddress')
            ->with('1111:2222:3333:4444:5555:6666:7777:8888')
            ->willReturn($resultMock)
            ;
        $this->versionServiceMock
            ->expects($this->once())
            ->method('getVersion')
            ->with('1111:2222:3333:4444:5555:6666:7777:8888')
            ->willReturn(6)
            ;
        $this->firstThreeQuadrantsBannedServiceMock
            ->expects($this->exactly(0))
            ->method('areFirstThreeQuadrantsBanned')
            ;
        $this->firstFourSegmentsBannedServiceMock
            ->expects($this->once())
            ->method('areFirstFourSegmentsBanned')
            ->with('1111:2222:3333:4444:5555:6666:7777:8888')
            ->willReturn(true)
            ;

        $this->assertTrue(
            $this->ipAddressService->isBanned(
                '1111:2222:3333:4444:5555:6666:7777:8888'
            )
        );
    }
}
