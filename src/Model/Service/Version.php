<?php
namespace MonthlyBasis\IpAddress\Model\Service;

use MonthlyBasis\IpAddress\Model\Exception as IpAddressException;

class Version
{
    /**
     * @throws IpAddressException
     */
    public function getVersion(
        string $ipAddress
    ): int {
        if (filter_var($ipAddress, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4)) {
            return 4;
        }

        if (filter_var($ipAddress, FILTER_VALIDATE_IP, FILTER_FLAG_IPV6)) {
            return 6;
        }

        throw new IpAddressException('Invalid IP Address.');
    }
}
