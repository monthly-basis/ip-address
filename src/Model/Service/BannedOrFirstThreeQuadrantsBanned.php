<?php
namespace MonthlyBasis\IpAddress\Model\Service;

use MonthlyBasis\IpAddress\Model\Service as IpAddressService;

class BannedOrFirstThreeQuadrantsBanned
{
    public function __construct(
        IpAddressService\Banned $bannedService,
        IpAddressService\FirstThreeQuadrantsBanned $firstThreeQuadrantsBannedService

    ) {
        $this->bannedService                    = $bannedService;
        $this->firstThreeQuadrantsBannedService = $firstThreeQuadrantsBannedService;
    }

    public function isBannedOrAreFirstThreeQuadrantsBanned(string $ipAddress)
    {
        return ($this->bannedService->isBanned($ipAddress)
            || $this->firstThreeQuadrantsBannedService->areFirstThreeQuadrantsBanned($ipAddress));
    }
}
