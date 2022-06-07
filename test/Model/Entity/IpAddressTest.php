<?php
namespace MonthlyBasis\IpAddressTest\Model\Entity;

use MonthlyBasis\IpAddress\Model\Entity as IpAddressEntity;
use PHPUnit\Framework\TestCase;

class IpAddressTest extends TestCase
{
    public function test_gettersAndSetters()
    {
        $ipAddressEntity = new IpAddressEntity\IpAddress();

        $countryCode = 'AU';
        $this->assertSame(
            $ipAddressEntity,
            $ipAddressEntity->setCountryCode($countryCode),
        );
        $this->assertSame(
            $countryCode,
            $ipAddressEntity->getCountryCode(),
        );

        $ipAddress = '1.2.3.4';
        $this->assertSame(
            $ipAddressEntity,
            $ipAddressEntity->setIpAddress($ipAddress),
        );
        $this->assertSame(
            $ipAddress,
            $ipAddressEntity->getIpAddress(),
        );
    }
}
