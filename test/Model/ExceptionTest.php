<?php
namespace MonthlyBasis\IpAddressTest\Model;

use MonthlyBasis\IpAddress\Model\Exception as IpAddressException;
use PHPUnit\Framework\TestCase;

class ExceptionTest extends TestCase
{
    protected function setUp(): void
    {
        $this->exception = new IpAddressException();
    }

    public function test_instance_expectedBehavior()
    {
        $this->assertInstanceOf(
            \Exception::class,
            $this->exception
        );
    }
}
