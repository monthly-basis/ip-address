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
                        $sm->get(IpAddressTable\Banned::class)
                    );
                },
                IpAddressService\BannedOrFirstThreeQuadrantsBanned::class => function ($sm) {
                    return new IpAddressService\BannedOrFirstThreeQuadrantsBanned(
                        $sm->get(IpAddressService\Banned::class),
                        $sm->get(IpAddressService\FirstThreeQuadrantsBanned::class)
                    );
                },
                IpAddressService\FirstThreeQuadrants::class => function ($sm) {
                    return new IpAddressService\FirstThreeQuadrants();
                },
                IpAddressService\FirstThreeQuadrantsBanned::class => function ($sm) {
                    return new IpAddressService\FirstThreeQuadrantsBanned(
                        $sm->get(IpAddressService\FirstThreeQuadrants::class),
                        $sm->get(IpAddressTable\BannedFirstThreeQuadrants::class)
                    );
                },
                IpAddressService\V6\FirstFourSegments::class => function ($sm) {
                    return new IpAddressService\V6\FirstFourSegments();
                },
                IpAddressService\Version::class => function ($sm) {
                    return new IpAddressService\Version();
                },
                IpAddressTable\Banned::class => function ($sm) {
                    return new IpAddressTable\Banned(
                        $sm->get('ip-address')
                    );
                },
                IpAddressTable\BannedFirstThreeQuadrants::class => function ($sm) {
                    return new IpAddressTable\BannedFirstThreeQuadrants(
                        $sm->get('ip-address')
                    );
                }
            ],
        ];
    }
}
