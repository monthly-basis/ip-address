<?php
namespace MonthlyBasis\IpAddress\Model\Service;

use MonthlyBasis\IpAddress\Model\Service as IpAddressService;
use MonthlyBasis\IpAddress\Model\Table as IpAddressTable;
use TypeError;

class FirstThreeQuadrantsBanned
{
    public function __construct(
        IpAddressService\FirstThreeQuadrants $firstThreeQuadrantsService,
        IpAddressTable\BannedFirstThreeQuadrants $bannedFirstThreeQuadrantsTable
    ) {
        $this->firstThreeQuadrantsService     = $firstThreeQuadrantsService;
        $this->bannedFirstThreeQuadrantsTable = $bannedFirstThreeQuadrantsTable;
    }

    /**
     * @param string $ipAddress
     * @return bool
     */
    public function areFirstThreeQuadrantsBanned(string $ipAddress)
    {
        $firstThreeQuadrants = $this->firstThreeQuadrantsService->getFirstThreeQuadrants(
            $ipAddress
        );

        try {
            $array = $this->bannedFirstThreeQuadrantsTable->selectWhereFirstThreeQuadrants(
                $firstThreeQuadrants
            );
        } catch (TypeError $typeError) {
            return false;
        }

        return true;
    }
}
