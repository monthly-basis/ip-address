<?php
namespace MonthlyBasis\IpAddressTest\Model\Table;

use MonthlyBasis\IpAddress\Model\Table as IpAddressTable;
use MonthlyBasis\LaminasTest\TableTestCase;

class BannedTest extends TableTestCase
{
    protected function setUp(): void
    {
        $this->bannedTable = new IpAddressTable\Banned($this->getAdapter());

        $this->dropTable('banned');
        $this->createTable('banned');
    }

    public function testDeleteWhereIpAddress()
    {
        $this->assertSame(
            0,
            $this->bannedTable->deleteWhereIpAddress('1.2.3.4')
        );
    }

    public function testSelectCountWhereIpAddressLikeAndCreatedGreaterThan()
    {
        $this->assertSame(
            0,
            $this->bannedTable->selectCountWhereIpAddressLikeAndCreatedGreaterThan(
                '1.2.3%',
                '2019-01-01 00:00:00'
            )
        );

        $this->bannedTable->insert(
            '1.2.3.4',
            0,
            'reason'
        );
        $this->bannedTable->insert(
            '1.2.3.123',
            0,
            'another reason'
        );

        $this->assertSame(
            2,
            $this->bannedTable->selectCountWhereIpAddressLikeAndCreatedGreaterThan(
                '1.2.3.%',
                '2019-01-01 00:00:00'
            )
        );

        $this->assertSame(
            0,
            $this->bannedTable->selectCountWhereIpAddressLikeAndCreatedGreaterThan(
                '123.234.255.%',
                '2019-01-01 00:00:00'
            )
        );
    }
}
