<?php
namespace LeoGalleguillos\IpAddress;

use LeoGalleguillos\IpAddress\Model\Factory as IpAddressFactory;
use LeoGalleguillos\IpAddress\Model\Service as IpAddressService;
use LeoGalleguillos\IpAddress\Model\Table as IpAddressTable;

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
                IpAddressTable\Banned::class => function ($sm) {
                    return new IpAddressTable\Banned(
                        $sm->get('ip-address')
                    );
                }
            ],
        ];
    }
}
