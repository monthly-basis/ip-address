<?php
namespace MonthlyBasis\IpAddress\Model\Service;

use MonthlyBasis\IpAddress\Model\Exception as IpAddressException;
use MonthlyBasis\IpAddress\Model\Service as IpAddressService;

class FirstThreeQuadrantsOrFirstFourSegments
{
    public function __construct(
        protected IpAddressService\V4\FirstThreeQuadrants $firstThreeQuadrantsService,
        protected IpAddressService\V6\FirstFourSegments $firstFourSegmentsService,
        protected IpAddressService\Version $versionService,
    ) {}

    public function getFirstThreeQuadrantsOrFirstFourSegments(
        string $ipAddress,
    ): string {
        $version = $this->versionService->getVersion($ipAddress);

        if ($version == 4) {
            return $this->firstThreeQuadrantsService->getFirstThreeQuadrants(
                $ipAddress
            );
        }

        if ($version == 6) {
            return $this->firstFourSegmentsService->getFirstFourSegments(
                $ipAddress
            );
        }

        throw new IpAddressException('Invalid IP Address.');
    }
}
