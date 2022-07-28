<?php
namespace MonthlyBasis\IpAddress\Model\Table;

use Laminas\Db\Adapter\Adapter;
use Laminas\Db\Adapter\Driver\Pdo\Result;

class BannedFirstFourSegments
{
    protected Adapter $adapter;

    public function __construct(Adapter $adapter)
    {
        $this->adapter = $adapter;
    }

    public function insertIgnore(
        string $firstFourSegments
    ): Result {
        $sql = '
            INSERT IGNORE
              INTO `banned_first_four_segments`
                   (`first_four_segments`, `created`)
            VALUES (?, UTC_TIMESTAMP());
        ';
        $parameters = [
            $firstFourSegments,
        ];
        return $this->adapter->query($sql)->execute($parameters);
    }

    public function select(): Result
    {
        $sql = '
            SELECT `first_four_segments`
                 , `created`
              FROM `banned_first_four_segments`
             ORDER
                BY `first_four_segments` ASC
                 ;
        ';
        return $this->adapter->query($sql)->execute();
    }

    public function selectWhereFirstFourSegments(
        string $firstFourSegments
    ): Result {
        $sql = '
            SELECT `first_four_segments`
                 , `created`
              FROM `banned_first_four_segments`
             WHERE `first_four_segments` = ?
                 ;
        ';
        $parameters = [
            $firstFourSegments,
        ];
        return $this->adapter->query($sql)->execute($parameters);
    }
}
