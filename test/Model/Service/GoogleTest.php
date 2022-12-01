<?php
namespace MonthlyBasis\IpAddressTest\Model\Service;

use MonthlyBasis\IpAddress\Model\Service as IpAddressService;
use PHPUnit\Framework\TestCase;

class GoogleTest extends TestCase
{
    protected function setUp(): void
    {
        $this->googleService = new IpAddressService\Google();
    }

    public function test_isGoogle_googleIpAddresses_true()
    {
        $this->assertTrue(
            $this->googleService->isGoogle('209.85.238.96')
        );
        $this->assertTrue(
            $this->googleService->isGoogle('209.85.238.99')
        );
        $this->assertTrue(
            $this->googleService->isGoogle('209.85.238.102')
        );
    }

    public function test_isGoogle_nonGoogleIpAddresses_false()
    {
        $this->assertFalse(
            $this->googleService->isGoogle('1.2.3.4')
        );
        $this->assertFalse(
            $this->googleService->isGoogle('0.0.0.0')
        );
        $this->assertFalse(
            $this->googleService->isGoogle('255.255.255.255')
        );

        $this->assertFalse(
            $this->googleService->isGoogle('2001:db8:0:1:1:1:1:1')
        );
        $this->assertFalse(
            $this->googleService->isGoogle('2001:0db8:85a3:0000:0000:8a2e:0370:7334')
        );
        $this->assertFalse(
            $this->googleService->isGoogle('684D:1111:222:3333:4444:5555:6:77')
        );
    }
}
