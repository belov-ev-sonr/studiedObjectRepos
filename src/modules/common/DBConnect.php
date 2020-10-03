<?php
namespace TestTask\Common;

use mysqli;
use TestTask\Common\Exceptions\DBConnectException;

class DBConnect
{
    /** @var mysqli */
    private static $mysqli;
    /** @var DBConnect */
    private static $instance;

    /**
     * DBConnect constructor.
     */
    private function __construct()
    {
        self::init();
    }

    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new self;
        }
        return self::$instance;
    }

    /**
     * @return mysqli
     */
    public function getMysqli()
    {
        $instance = self::getInstance();
        return $instance::$mysqli;
    }

    public function executeQuery(string $query)
    {
        return $this->getMysqli()->query($query);
    }

    public static function init(): void
    {
        $host = getenv('DB_HOST');
        $user = getenv('DB_USER');
        $pass = getenv('DB_PASS');
        $dbName = getenv('DB_NAME');
        $port = getenv('DB_PORT');
        $resource = new \mysqli($host, $user, $pass, $dbName, $port);
        self::isDBError($resource);
        self::$mysqli = $resource;
    }

    private static function isDBError(mysqli $resource): void
    {
        if ($resource->connect_error) {
            throw new DBConnectException();
        }
    }
}
