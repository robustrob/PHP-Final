<?php
/**
 * Created by PhpStorm.
 * User: Roberto
 * Date: 25/04/2016
 * Time: 10:32 PM
 */
require_once 'Database.php';

class Model
{
    protected $db;
    /**
     * Model constructor.
     * All json come with a db connection because is good to have....
     */
    public function __construct()
    {
        $this->db = Database::noParam();
    }
    /**
     * DB Testing purposes
     * @return array error array
     */
    public function getError()
    {
        return $this->db->errorInfo();
    }
}