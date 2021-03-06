<?php
namespace MonthlyBasis\IpAddress\Model\Service;

use MonthlyBasis\IpAddress\Model\Service as IpAddressService;
use MonthlyBasis\IpAddress\Model\Table as IpAddressTable;

class BanAndConditionallyBanFirstThreeQuadrants
{
    public function __construct(
        IpAddressService\Ban $banService,
        IpAddressService\BanFirstThreeQuadrants $banFirstThreeQuadrantsService,
        IpAddressService\FirstThreeQuadrants $firstThreeQuadrantsService,
        IpAddressTable\Banned $bannedTable
    ) {
        $this->banService                    = $banService;
        $this->banFirstThreeQuadrantsService = $banFirstThreeQuadrantsService;
        $this->firstThreeQuadrantsService    = $firstThreeQuadrantsService;
        $this->bannedTable                   = $bannedTable;
    }

    public function banAndConditionallyBanFirstThreeQuadrants(
        string $ipAddress,
        int $userId,
        string $reason
    ) {
        $this->banService->ban(
            $ipAddress,
            $userId,
            $reason
        );

        $firstThreeQuadrants = $this->firstThreeQuadrantsService->getFirstThreeQuadrants(
            $ipAddress
        );

        $count = $this->bannedTable->selectCountWhereIpAddressLikeAndCreatedGreaterThan(
            $firstThreeQuadrants . '.%',
            date('Y-m-d H:i:s', strtotime('-32 days'))
        );

        if ($count >= 3) {
            $this->banFirstThreeQuadrantsService->banFirstThreeQuadrants(
                $firstThreeQuadrants
            );
        }
    }
}
