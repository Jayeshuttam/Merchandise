<?php

/*
 * class for database using PDO to connect to  any type of sql servers including Mysql servers
 *
 */
class db_pdo
{
    public $db_host = '127.0.0.1';
    public $db_user_name = 'electric_scooters';
    public $db_user_pw = 'electric_scooters';
    public $db_name = 'electric_scooter';
    public $connection;

    public function __construct()
    {
        try {
            $this->connection = new PDO('mysql:host='.$this->db_host.';dbname='.$this->db_name, $this->db_user_name, $this->db_user_pw);
        } catch (PDOException $e) {
            echo 'Error!: '.$e->getMessage().'<br/>';
            die();
        }
        // echo 'Connected to DB!s';
    }

    /**
     * Query for all the operation like update insert delete that returns no records.
     */
    public function query($sql_str)
    {
        try {
            $result = $this->connection->query($sql_str);
            if (!$result) {
                die('Sql query error');
            }
        } catch (\PDOException $e) {
            throw new \PDOException($e->getMessage(), (int) $e->getCode());
        }

        return $result;
    }

    /**
     * Query for all the operation like update insert delete that returns records
     * converted in PHP array.
     */
    public function querySelect($sql_str)
    {
        $records = $this->query($sql_str)->fetchAll();

        return $records;
    }

    /**
     * return the whole table from the table.
     */
    public function table($table_name)
    {
        return $this->querySelect('select * from '.$table_name);
    }

    public function disconnect()
    {
        $this->connection = null;
    }
}
