<?php
namespace MonthlyBasis\IpAddressTest\Model\Service;

use MonthlyBasis\IpAddress\Model\Service as IpAddressService;
use PHPUnit\Framework\TestCase;

class BingbotTest extends TestCase
{
    protected function setUp(): void
    {
        $this->bingbotService = new IpAddressService\Bingbot();
    }

    public function test_isBingbot_bingbotIpAddresses_true()
    {
        $this->assertTrue(
            $this->bingbotService->isBingbot('157.55.39.215')
        );
        $this->assertTrue(
            $this->bingbotService->isBingbot('207.46.13.129')
        );
        $this->assertTrue(
            $this->bingbotService->isBingbot('207.46.13.152')
        );
        $this->assertTrue(
            $this->bingbotService->isBingbot('157.55.39.23')
        );
        $this->assertTrue(
            $this->bingbotService->isBingbot('40.77.167.39')
        );
        $this->assertTrue(
            $this->bingbotService->isBingbot('157.55.39.227')
        );
    }

    public function test_isBingbot_nonBingbotIpAddresses_false()
    {
        $this->assertFalse(
            $this->bingbotService->isBingbot('1.2.3.4')
        );
        $this->assertFalse(
            $this->bingbotService->isBingbot('0.0.0.0')
        );
        $this->assertFalse(
            $this->bingbotService->isBingbot('255.255.255.255')
        );

        $this->assertFalse(
            $this->bingbotService->isBingbot('2001:db8:0:1:1:1:1:1')
        );
        $this->assertFalse(
            $this->bingbotService->isBingbot('2001:0db8:85a3:0000:0000:8a2e:0370:7334')
        );
        $this->assertFalse(
            $this->bingbotService->isBingbot('684D:1111:222:3333:4444:5555:6:77')
        );
    }
}
