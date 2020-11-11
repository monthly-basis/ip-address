<?php
namespace MonthlyBasis\IpAddress\Model\Service;

use MonthlyBasis\IpAddress\Model\Table as IpAddressTable;

class Ban
{
    public function __construct(
        IpAddressTable\Banned $bannedTable
    ) {
        $this->bannedTable = $bannedTable;
    }

    public function ban(
        string $ipAddress,
        int $userId,
        string $reason
    ): bool {
        return (bool) $this->bannedTable->insert(
            $ipAddress,
            $userId,
            $reason
        );
    }
}
