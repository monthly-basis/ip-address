<?php
namespace MonthlyBasis\IpAddress;

use MonthlyBasis\IpAddress\Model\Factory as IpAddressFactory;
use MonthlyBasis\IpAddress\Model\Service as IpAddressService;
use MonthlyBasis\IpAddress\Model\Table as IpAddressTable;

class Module
{
    public function getConfig()
    {
        return [
            'view_helpers' => [
                'factories' => [
                ],
            ],
        ];
    }

    public function getServiceConfig()
    {
        return [
            'factories' => [
                IpAddressService\Ban::class => function ($sm) {
                    return new IpAddressService\Ban(
                        $sm->get(IpAddressTable\Banned::class)
                    );
                },
                IpAddressService\BanAndConditionallyBanFirstThreeQuadrants::class => function ($sm) {
                    return new IpAddressService\BanAndConditionallyBanFirstThreeQuadrants(
                        $sm->get(IpAddressService\Ban::class),
                        $sm->get(IpAddressService\BanFirstThreeQuadrants::class),
                        $sm->get(IpAddressService\FirstThreeQuadrants::class),
                        $sm->get(IpAddressTable\Banned::class)
                    );
                },
                IpAddressService\BanFirstThreeQuadrants::class => function ($sm) {
                    return new IpAddressService\BanFirstThreeQuadrants(
                        $sm->get(IpAddressTable\BannedFirstThreeQuadrants::class)
                    );
                },
                IpAddressService\Banned::class => function ($sm) {
                    return new IpAddressService\Banned(
                        $sm->get(IpAddressService\FirstThreeQuadrantsBanned::class),
                        $sm->get(IpAddressService\V6\FirstFourSegmentsBanned::class),
                        $sm->get(IpAddressService\Version::class),
                        $sm->get(IpAddressTable\Banned::class),
                    );
                },
                /**
                 * @deprecated Use IpAddressService\V4\FirstThreeQuadrants() instead.
                 */
                IpAddressService\FirstThreeQuadrants::class => function ($sm) {
                    return new IpAddressService\FirstThreeQuadrants();
                },
                IpAddressService\FirstThreeQuadrantsBanned::class => function ($sm) {
                    return new IpAddressService\FirstThreeQuadrantsBanned(
                        $sm->get(IpAddressService\FirstThreeQuadrants::class),
                        $sm->get(IpAddressTable\BannedFirstThreeQuadrants::class)
                    );
                },
                IpAddressService\Googlebot::class => function ($sm) {
                    return new IpAddressService\Googlebot();
                },
                IpAddressService\V4\BannedFirstThreeQuadrants::class => function ($sm) {
                    return new IpAddressService\V4\BannedFirstThreeQuadrants(
                        $sm->get(IpAddressTable\BannedFirstThreeQuadrants::class)
                    );
                },
                IpAddressService\V4\FirstThreeQuadrants::class => function ($sm) {
                    return new IpAddressService\V4\FirstThreeQuadrants();
                },
                IpAddressService\V6\BannedFirstFourSegments::class => function ($sm) {
                    return new IpAddressService\V6\BannedFirstFourSegments(
                        $sm->get(IpAddressTable\BannedFirstFourSegments::class)
                    );
                },
                IpAddressService\V6\FirstFourSegments::class => function ($sm) {
                    return new IpAddressService\V6\FirstFourSegments();
                },
                IpAddressService\V6\FirstFourSegmentsBanned::class => function ($sm) {
                    return new IpAddressService\V6\FirstFourSegmentsBanned(
                        $sm->get(IpAddressService\V6\FirstFourSegments::class),
                        $sm->get(IpAddressTable\BannedFirstFourSegments::class)
                    );
                },
                IpAddressService\Version::class => function ($sm) {
                    return new IpAddressService\Version();
                },
                IpAddressTable\Banned::class => function ($sm) {
                    return new IpAddressTable\Banned(
                        $sm->get('ip-address')
                    );
                },
                IpAddressTable\BannedFirstFourSegments::class => function ($sm) {
                    return new IpAddressTable\BannedFirstFourSegments(
                        $sm->get('ip-address')
                    );
                },
                IpAddressTable\BannedFirstThreeQuadrants::class => function ($sm) {
                    return new IpAddressTable\BannedFirstThreeQuadrants(
                        $sm->get('ip-address')
                    );
                },
            ],
        ];
    }
}
