<?php
namespace LeoGalleguillos\IpAddress\Model\Table;

use Generator;
use Zend\Db\Adapter\Adapter;

class Banned
{
    /**
     * @var Adapter
     */
    protected $adapter;

    public function __construct(Adapter $adapter)
    {
        $this->adapter = $adapter;
    }

    public function deleteWhereIpAddress(string $ipAddress): int
    {
        $sql = 'DELETE FROM `banned` WHERE `ip_address` = ?';
        $parameters = [
            $ipAddress,
        ];
        return $this->adapter
            ->query($sql)
            ->execute($parameters)
            ->getAffectedRows();
    }

    public function insert(
        string $ipAddress,
        int $userId,
        string $reason
    ): int {
        $sql = '
            INSERT
              INTO `banned`
                   (`ip_address`, `user_id`, `reason`, `created`)
            VALUES (?, ?, ?, UTC_TIMESTAMP());
        ';
        $parameters = [
            $ipAddress,
            $userId,
            $reason,
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
            SELECT `ip_address`
                 , `user_id`
                 , `reason`
                 , `created`
              FROM `banned`
             ORDER
                BY `ip_address` ASC
                 ;
        ';
        foreach ($this->adapter->query($sql)->execute() as $array) {
            yield $array;
        }
    }

    public function selectWhereIpAddress(string $ipAddress): array
    {
        $sql    = '
            SELECT `ip_address`
                 , `user_id`
                 , `reason`
                 , `created`
              FROM `banned`
             WHERE `ip_address` = ?
                 ;
        ';
        $parameters = [
            $ipAddress,
        ];
        return $this->adapter->query($sql)->execute($parameters)->current();
    }
}
