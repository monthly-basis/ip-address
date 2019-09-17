<?php
namespace LeoGalleguillos\IpAddress\Model\Service;

use LeoGalleguillos\IpAddress\Model\Table as IpAddressTable;

class BanFirstThreeQuadrants
{
    public function __construct(
        IpAddressTable\BannedFirstThreeQuadrants $bannedFirstThreeQuadrantsTable
    ) {
        $this->bannedFirstThreeQuadrantsTable = $bannedFirstThreeQuadrantsTable;
    }

    public function banFirstThreeQuadrants(
        string $firstThreeQuadrants
    ): bool {
        return (bool) $this->bannedFirstThreeQuadrantsTable->insert(
            $firstThreeQuadrants
        );
    }
}
