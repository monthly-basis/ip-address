<?php
namespace LeoGalleguillos\IpAddressTest\Model\Table;

use LeoGalleguillos\IpAddress\Model\Table as IpAddressTable;
use LeoGalleguillos\Test\TableTestCase;
use Zend\Db\Adapter\Exception\InvalidQueryException;

class BannedTest extends TableTestCase
{
    protected function setUp()
    {
        $this->imageTable = new IpAddressTable\Banned($this->getAdapter());

        $this->dropTable('banned');
        $this->createTable('banned');
    }
}
