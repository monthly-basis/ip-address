<?php
namespace MonthlyBasis\IpAddressTest\Model\Table;

use MonthlyBasis\IpAddress\Model\Table as IpAddressTable;
use MonthlyBasis\LaminasTest\TableTestCase;

class BannedFirstThreeQuadrantsTest extends TableTestCase
{
    protected function setUp(): void
    {
        $this->bannedFirstThreeQuadrantsTable = new IpAddressTable\BannedFirstThreeQuadrants($this->getAdapter());

        $this->dropTable('banned_first_three_quadrants');
        $this->createTable('banned_first_three_quadrants');
    }

    public function test_insertIgnore()
    {
        $this->assertSame(
            1,
            $this->bannedFirstThreeQuadrantsTable->insertIgnore('1.2.3')
        );

        $this->assertSame(
            0,
            $this->bannedFirstThreeQuadrantsTable->insertIgnore('1.2.3')
        );
    }

    public function test_select()
    {
        $result = $this->bannedFirstThreeQuadrantsTable->select();
        $this->assertEmpty(
            iterator_to_array($result)
        );

        $this->bannedFirstThreeQuadrantsTable->insertIgnore('1.2.3');
        $this->bannedFirstThreeQuadrantsTable->insertIgnore('7.8.9');
        $this->bannedFirstThreeQuadrantsTable->insertIgnore('123.456.789');

        $result = $this->bannedFirstThreeQuadrantsTable->select();
        $array = iterator_to_array($result);

        $this->assertSame(
            '1.2.3',
            $array[0]['first_three_quadrants']
        );
        $this->assertSame(
            '123.456.789',
            $array[1]['first_three_quadrants']
        );
        $this->assertSame(
            '7.8.9',
            $array[2]['first_three_quadrants']
        );
    }
}
