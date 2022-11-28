<?php
namespace MonthlyBasis\IpAddressTest\Model\Service;

use MonthlyBasis\IpAddress\Model\Service as IpAddressService;
use PHPUnit\Framework\TestCase;

class GooglebotTest extends TestCase
{
    protected function setUp(): void
    {
        $this->googlebotService = new IpAddressService\Googlebot();
    }

    public function test_isGooglebot_googlebotIpAddresses_true()
    {
        $this->assertTrue(
            $this->googlebotService->isGooglebot('34.147.110.152')
        );
        $this->assertTrue(
            $this->googlebotService->isGooglebot('66.249.65.224')
        );
        $this->assertTrue(
            $this->googlebotService->isGooglebot('66.249.65.227')
        );
        $this->assertTrue(
            $this->googlebotService->isGooglebot('66.249.68.50')
        );
        $this->assertTrue(
            $this->googlebotService->isGooglebot('66.249.73.52')
        );

        $this->assertTrue(
            $this->googlebotService->isGooglebot('2001:4860:4801:50::31')
        );
        $this->assertTrue(
            $this->googlebotService->isGooglebot('2001:4860:4801:14::ce')
        );
        $this->assertTrue(
            $this->googlebotService->isGooglebot('2001:4860:4801:0014:0000:0000:0000:00ce')
        );
    }

    public function test_isGooglebot_nonGooglebotIpAddresses_false()
    {
        $this->assertFalse(
            $this->googlebotService->isGooglebot('1.2.3.4')
        );
        $this->assertFalse(
            $this->googlebotService->isGooglebot('0.0.0.0')
        );
        $this->assertFalse(
            $this->googlebotService->isGooglebot('255.255.255.255')
        );

        $this->assertFalse(
            $this->googlebotService->isGooglebot('2001:db8:0:1:1:1:1:1')
        );
        $this->assertFalse(
            $this->googlebotService->isGooglebot('2001:0db8:85a3:0000:0000:8a2e:0370:7334')
        );
        $this->assertFalse(
            $this->googlebotService->isGooglebot('684D:1111:222:3333:4444:5555:6:77')
        );
    }
}
