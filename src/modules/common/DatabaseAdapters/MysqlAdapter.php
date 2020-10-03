<?php
namespace TestTask\Common\DatabaseAdapters;

use TestTask\Common\Exceptions\MysqlRequestException;
use TestTask\Common\DBConnect;

class MysqlAdapter implements DatabaseAdapter
{
    /** @var DBConnect */
    private $dbConnect;

    /**
     * MysqlAdapter constructor.
     */
    public function __construct()
    {
        $this->dbConnect = DBConnect::getInstance();
    }

    /**
     * @return DBConnect
     */
    private function getDbConnect(): DBConnect
    {
        return $this->dbConnect;
    }


    public function select(string $request, array $option = []): array
    {
        $resultQuery = $this->executeQuery($request);
        $result = $resultQuery->fetch_all(MYSQLI_ASSOC);
        return $result;
    }

    public function insert(string $request): int
    {
        $this->executeQuery($request);
        return $this->getLastInsertId();
    }

    private function getLastInsertId(): int
    {
        return (int)$this->getDbConnect()->getMysqli()->insert_id;
    }

    public function update(string $request): bool
    {
        $resultQuery = $this->executeQuery($request);
        return (bool)$resultQuery;
    }

    public function delete(string $request): bool
    {
        $resultQuery = $this->executeQuery($request);
        return (bool)$resultQuery;
    }

    private function executeQuery(string $sql)
    {
        $resultQuery = $this->getDbConnect()->getMysqli()->query($sql);
        if (!$resultQuery) {
            throw new MysqlRequestException();
        }

        return $resultQuery;
    }
}
