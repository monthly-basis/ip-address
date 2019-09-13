<?php
namespace LeoGalleguillos\IpAddress\Model\Table;

use Generator;
use TypeError;
use Zend\Db\Adapter\Adapter;

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

    public function insert(
        string $firstThreeQuadrants
    ): int {
        $sql = '
            INSERT
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

    /**
     * @yield array
     */
    public function select(): Generator
    {
        $sql = '
            SELECT `first_three_quadrants`
                 , `created`
              FROM `banned_first_three_quadrants`
             ORDER
                BY `first_three_quadrants` ASC
                 ;
        ';
        foreach ($this->adapter->query($sql)->execute() as $array) {
            yield $array;
        }
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
