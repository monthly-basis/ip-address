<?php
namespace LeoGalleguillos\IpAddressTest\Model\Table;

use LeoGalleguillos\IpAddress\Model\Table as IpAddressTable;
use LeoGalleguillos\Test\TableTestCase;

class BannedTest extends TableTestCase
{
    protected function setUp()
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
}
