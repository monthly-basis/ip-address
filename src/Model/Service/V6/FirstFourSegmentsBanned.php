<?php
namespace MonthlyBasis\IpAddress\Model\Service\V6;

use MonthlyBasis\IpAddress\Model\Service as IpAddressService;
use MonthlyBasis\IpAddress\Model\Table as IpAddressTable;
use TypeError;

class FirstFourSegmentsBanned
{
    public function __construct(
        IpAddressService\V6\FirstFourSegments $firstFourSegmentsService,
        IpAddressTable\BannedFirstFourSegments $bannedFirstFourSegmentsTable
    ) {
        $this->firstFourSegmentsService     = $firstFourSegmentsService;
        $this->bannedFirstFourSegmentsTable = $bannedFirstFourSegmentsTable;
    }

    public function areFirstFourSegmentsBanned(string $v6IpAddress): bool
    {
        $firstFourSegments = $this->firstFourSegmentsService->getFirstFourSegments(
            $v6IpAddress
        );

        $result = $this->bannedFirstFourSegmentsTable->selectWhereFirstFourSegments(
            $firstFourSegments
        );

        return ($result->current() === false);
    }
}
