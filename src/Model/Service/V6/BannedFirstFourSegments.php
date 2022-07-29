<?php
namespace MonthlyBasis\IpAddress\Model\Service\V6;

use Generator;
use MonthlyBasis\IpAddress\Model\Table as IpAddressTable;

class BannedFirstFourSegments
{
    public function __construct(
        IpAddressTable\BannedFirstFourSegments $bannedFirstFourSegmentsTable
    ) {
        $this->bannedFirstFourSegmentsTable = $bannedFirstFourSegmentsTable;
    }

    public function getBannedFirstFourSegments(): Generator
    {
        $result = $this->bannedFirstFourSegmentsTable->select();

        foreach ($result as $array) {
            yield $array;
        }
    }
}
