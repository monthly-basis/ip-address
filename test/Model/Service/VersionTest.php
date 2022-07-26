<?php
namespace MonthlyBasis\IpAddressTest\Model\Service;

use MonthlyBasis\IpAddress\Model\Exception as IpAddressException;
use MonthlyBasis\IpAddress\Model\Service as IpAddressService;
use PHPUnit\Framework\TestCase;

class VersionTest extends TestCase
{
    protected function setUp(): void
    {
        $this->versionService = new IpAddressService\Version();
    }

    public function test_getVersion_ipv4s_4()
    {
        $this->assertSame(
            $this->versionService->getVersion('1.2.3.4'),
            4
        );

        $this->assertSame(
            $this->versionService->getVersion('255.255.255.255'),
            4
        );
    }

    public function test_getVersion_ipv6s_6()
    {
        $ipAddress = '2001:0db8:85a3:0000:0000:8a2e:0370:7334';
        $this->assertSame(
            $this->versionService->getVersion($ipAddress),
            6
        );

        $ipAddress = 'fe80::1ff:fe23:4567:890a';
        $this->assertSame(
            $this->versionService->getVersion($ipAddress),
            6
        );

        $ipAddress = '0000:0000:0000:0000:0000:0000:0000:0001';
        $this->assertSame(
            $this->versionService->getVersion($ipAddress),
            6
        );

        $ipAddress = '::1';
        $this->assertSame(
            $this->versionService->getVersion($ipAddress),
            6
        );
    }

    public function test_getVersion_invalidIps_throwException()
    {
        $ipAddress = 'invalid IP address';
        try {
            $this->versionService->getVersion($ipAddress);
            $this->fail();
        } catch (IpAddressException $ipAddressException) {
            $this->assertSame(
                'Invalid IP Address.',
                $ipAddressException->getMessage(),
            );
        }

        $ipAddress = '';
        try {
            $this->versionService->getVersion($ipAddress);
            $this->fail();
        } catch (IpAddressException $ipAddressException) {
            $this->assertSame(
                'Invalid IP Address.',
                $ipAddressException->getMessage(),
            );
        }
    }
}
