<?php
namespace MonthlyBasis\IpAddress\Model\Service;

use MonthlyBasis\IpAddress\Model\Service as IpAddressService;
use MonthlyBasis\IpAddress\Model\Table as IpAddressTable;
use TypeError;

class Banned
{
    public function __construct(
        IpAddressService\FirstThreeQuadrantsBanned $firstThreeQuadrantsBannedService,
        IpAddressService\V6\FirstFourSegmentsBanned $firstFourSegmentsBannedService,
        IpAddressService\Version $versionService,
        IpAddressTable\Banned $bannedTable
    ) {
        $this->firstThreeQuadrantsBannedService = $firstThreeQuadrantsBannedService;
        $this->firstFourSegmentsBannedService   = $firstFourSegmentsBannedService;
        $this->versionService                   = $versionService;
        $this->bannedTable                      = $bannedTable;
    }

    public function isBanned(string $ipAddress)
    {
        $result = $this->bannedTable->selectWhereIpAddress($ipAddress);
        if ($result->current() !== false) {
            return true;
        }

        $version = $this->versionService->getVersion($ipAddress);

        if ($version == 4) {
            return $this->firstThreeQuadrantsBannedService->areFirstThreeQuadrantsBanned($ipAddress);
        }

        return $this->firstFourSegmentsBannedService->areFirstFourSegmentsBanned($ipAddress);
    }
}
