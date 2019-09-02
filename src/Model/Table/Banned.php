<?php
namespace LeoGalleguillos\IpAddress\Model\Table;

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

    public function insert(
        string $rootRelativeUrl
    ): int {
        $sql = '
            INSERT
              INTO `banned` (
                       `root_relative_url`
                   )
            VALUES (?)
                 ;
        ';
        $parameters = [
            $rootRelativeUrl,
        ];
        return (int) $this->adapter
                          ->query($sql)
                          ->execute($parameters)
                          ->getGeneratedValue();
    }
}
