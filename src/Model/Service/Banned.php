<?php
namespace MonthlyBasis\IpAddress\Model\Service;

use MonthlyBasis\IpAddress\Model\Table as IpAddressTable;
use TypeError;

class Banned
{
    public function __construct(
        IpAddressTable\Banned $bannedTable
    ) {
        $this->bannedTable = $bannedTable;
    }

    public function isBanned(string $ipAddress)
    {
        try {
            $array = $this->bannedTable->selectWhereIpAddress($ipAddress);
        } catch (TypeError $typeError) {
            return false;
        }

        return true;
    }
}
