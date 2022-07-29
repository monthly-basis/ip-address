<?php
namespace MonthlyBasis\IpAddress\Model\Service\V4;

use Generator;
use MonthlyBasis\IpAddress\Model\Table as IpAddressTable;

class BannedFirstThreeQuadrants
{
    public function __construct(
        IpAddressTable\BannedFirstThreeQuadrants $bannedFirstThreeQuadrantsTable
    ) {
        $this->bannedFirstThreeQuadrantsTable = $bannedFirstThreeQuadrantsTable;
    }

    public function getBannedFirstThreeQuadrants(): Generator
    {
        $result = $this->bannedFirstThreeQuadrantsTable->select();

        foreach ($result as $array) {
            yield $array['first_three_quadrants'];
        }
    }
}
