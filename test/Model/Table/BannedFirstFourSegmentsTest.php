<?php
namespace MonthlyBasis\IpAddressTest\Model\Table;

use MonthlyBasis\IpAddress\Model\Table as IpAddressTable;
use MonthlyBasis\LaminasTest\TableTestCase;

class BannedFirstFourSegmentsTest extends TableTestCase
{
    protected function setUp(): void
    {
        $this->bannedFirstFourSegmentsTable = new IpAddressTable\BannedFirstFourSegments($this->getAdapter());

        $this->dropAndCreateTable('banned_first_four_segments');
    }

    public function test_insertIgnore()
    {
        $firstFourSegments = '1111.2222.3333.4444';
        $this->assertSame(
            1,
            $this->bannedFirstFourSegmentsTable->insertIgnore($firstFourSegments)->getAffectedRows()
        );

        $this->assertSame(
            0,
            $this->bannedFirstFourSegmentsTable->insertIgnore($firstFourSegments)->getAffectedRows()
        );
    }

    public function test_select()
    {
        $result = $this->bannedFirstFourSegmentsTable->select();
        $this->assertEmpty(
            iterator_to_array($result)
        );

        $this->bannedFirstFourSegmentsTable->insertIgnore('1111.2222.3333.4444');
        $this->bannedFirstFourSegmentsTable->insertIgnore('5555.6666.7777.8888');
        $this->bannedFirstFourSegmentsTable->insertIgnore('9999.aaaa.bbbb.cccc');

        $result = $this->bannedFirstFourSegmentsTable->select();
        $array = iterator_to_array($result);

        $this->assertSame(
            '1111.2222.3333.4444',
            $array[0]['first_four_segments']
        );
        $this->assertSame(
            '5555.6666.7777.8888',
            $array[1]['first_four_segments']
        );
        $this->assertSame(
            '9999.aaaa.bbbb.cccc',
            $array[2]['first_four_segments']
        );
    }
}
