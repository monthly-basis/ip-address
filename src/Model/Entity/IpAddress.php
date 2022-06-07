<?php
namespace MonthlyBasis\IpAddress\Model\Entity;

class IpAddress
{
    protected string $countryCode;
    protected string $ipAddress;

    public function getCountryCode(): string
    {
        return $this->countryCode;
    }

    public function getIpAddress(): string
    {
        return $this->ipAddress;
    }

    public function setCountryCode(string $countryCode): self
    {
        $this->countryCode = $countryCode;
        return $this;
    }

    public function setIpAddress(string $ipAddress): self
    {
        $this->ipAddress = $ipAddress;
        return $this;
    }
}
