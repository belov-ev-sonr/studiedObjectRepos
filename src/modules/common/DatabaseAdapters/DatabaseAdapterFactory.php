<?php
namespace TestTask\Common\DatabaseAdapters;

class DatabaseAdapterFactory
{
    public static function create(): DatabaseAdapter
    {
        return new MysqlAdapter();
    }
}
