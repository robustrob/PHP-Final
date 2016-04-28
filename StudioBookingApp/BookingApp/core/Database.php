<?php
/**
 * Created by PhpStorm.
 * User: Roberto
 * Date: 25/04/2016
 * Time: 1:54 PM
 */

class Database extends PDO
{
    private static $instance = NULL;

    public function __construct($DB_TYPE, $DB_HOST, $DB_NAME, $DB_USER, $DB_PASS)
    {
        parent::__construct($DB_TYPE . ':host=' . $DB_HOST . ';dbname=' . $DB_NAME . ';charset=utf8', $DB_USER, $DB_PASS);
        //parent::setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTIONS);
    }

    public static function noParam()
    {
        return new Database(DB_TYPE, DB_HOST, DB_NAME, DB_USER, DB_PASS);
    }

    private function __clone() {}

    /**
     * select
     * @param string $sql An SQL string
     * @param array $array Parameters to bind
     * @param int $fetchMode A PDO Fetch mode
     * @return mixed
     */
    public function select($sql, $array = array(), $fetchMode = PDO::FETCH_ASSOC)
    {
        $sth = $this->prepare($sql);
        foreach ($array as $key => $value) {
            $sth->bindValue("$key", $value);
        }
        $sth->execute();
        return $sth->fetchAll($fetchMode);
    }
    /**
     * insert
     * @param string $table A name of table to insert into
     * @param array $data An associative array
     * @return boolean
     */
    public function insert($table, Array $data)
    {
        ksort($data);
        $fieldNames = implode('`,`', array_keys($data));
        $fieldValues = ':' . implode(', :', array_keys($data));
        /** @noinspection SqlResolve */
        $sth = $this->prepare("INSERT INTO $table (`$fieldNames`) VALUES ($fieldValues)");
        foreach ($data as $key => $value) {
            $sth->bindValue(":$key", $value);
        }
        return $sth->execute();
    }
    /**
     * update
     * @param string $table A name of table to insert into
     * @param array $data An associative array
     * @param string $where the WHERE query part
     * @return bool
     */
    public function update($table, Array $data, $where)
    {
        ksort($data);
        $fieldDetails = NULL;
        foreach ($data as $key => $value) {
            $fieldDetails .= "`$key`=:$key,";
        }
        $fieldDetails = rtrim($fieldDetails, ',');
        $sth = $this->prepare("UPDATE $table SET $fieldDetails WHERE $where");
        foreach ($data as $key => $value) {
            $sth->bindValue(":$key", $value);
        }
        return $sth->execute();
    }
    /**
     * delete
     * @param string $table
     * @param string $where
     * @param integer $limit
     * @return integer Affected Rows
     */
    public function delete($table, $where, $limit = 1)
    {
        $sth = $this->exec("DELETE FROM ".$table." WHERE ".$where ."LIMIT ".$limit);
        return $sth;
    }



}