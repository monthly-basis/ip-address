<?php
namespace LeoGalleguillos\IpAddressTest\Model\Table;

use LeoGalleguillos\IpAddress\Model\Table as IpAddressTable;
use LeoGalleguillos\Test\TableTestCase;

class BannedFirstThreeQuadrantsTest extends TableTestCase
{
    protected function setUp(): void
    {
        $this->bannedFirstThreeQuadrantsTable = new IpAddressTable\BannedFirstThreeQuadrants($this->getAdapter());

        $this->dropTable('banned_first_three_quadrants');
        $this->createTable('banned_first_three_quadrants');
    }

    public function testInsert()
    {
        $this->assertSame(
            1,
            $this->bannedFirstThreeQuadrantsTable->insert('1.2.3')
        );
    }

    public function testSelect()
    {
        $generator = $this->bannedFirstThreeQuadrantsTable->select();
        $this->assertEmpty(
            iterator_to_array($generator)
        );

        $this->bannedFirstThreeQuadrantsTable->insert('1.2.3');
        $this->bannedFirstThreeQuadrantsTable->insert('7.8.9');
        $this->bannedFirstThreeQuadrantsTable->insert('123.456.789');

        $generator = $this->bannedFirstThreeQuadrantsTable->select();
        $array = iterator_to_array($generator);

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
