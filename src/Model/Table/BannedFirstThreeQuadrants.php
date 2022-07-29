<?php
namespace MonthlyBasis\IpAddress\Model\Table;

use Generator;
use TypeError;
use Laminas\Db\Adapter\Adapter;
use Laminas\Db\Adapter\Driver\Pdo\Result;

class BannedFirstThreeQuadrants
{
    /**
     * @var Adapter
     */
    protected $adapter;

    public function __construct(Adapter $adapter)
    {
        $this->adapter = $adapter;
    }

    public function insertIgnore(
        string $firstThreeQuadrants
    ): int {
        $sql = '
            INSERT IGNORE
              INTO `banned_first_three_quadrants`
                   (`first_three_quadrants`, `created`)
            VALUES (?, UTC_TIMESTAMP());
        ';
        $parameters = [
            $firstThreeQuadrants,
        ];
        return $this->adapter
            ->query($sql)
            ->execute($parameters)
            ->getAffectedRows();
    }

    public function select(): Result
    {
        $sql = '
            SELECT `first_three_quadrants`
                 , `created`
              FROM `banned_first_three_quadrants`
             ORDER
                BY `first_three_quadrants` ASC
                 ;
        ';
        return $this->adapter->query($sql)->execute();
    }

    /**
     * @throws TypeError
     */
    public function selectWhereFirstThreeQuadrants(string $firstThreeQuadrants): array
    {
        $sql    = '
            SELECT `first_three_quadrants`
                 , `created`
              FROM `banned_first_three_quadrants`
             WHERE `first_three_quadrants` = ?
                 ;
        ';
        $parameters = [
            $firstThreeQuadrants,
        ];
        return $this->adapter->query($sql)->execute($parameters)->current();
    }
}
