<?php
namespace Adoms\src\crud;
error_reporting(E_ALL);
ini_set('display_errors',1);

class db {

    private $ini;
    public $db; // handle for database

    public function testCRUD() {

        $vals = array (
            "store_name" => "big j\'s",
            "slogan" => "much ado",
            "description" => "no",
            "img" => "tester",
            "total_paid" => 0,
            "last_paid_on" => "02/18/2020",
            "flags" => 0,
            "start" => 10,
            "end" => 20,
            "serial" => null,
            "url" => null,
            "seen" => 0,
            "zip" => 48507,
            "nums" => 1
        );

        $database = "adrs";
        
        $this->create($vals, "advs", $database);

        $data_test = array(
            "advs" => array("store_name", "slogan"));

        $this->read($data_test, "`slogan` = 'much ado'");

        $this->update("advs",array("slogan"=>"heyhey!"),1);

        $this->delete("advs",1);

    }

    function __construct(string $config = "../../config/db.ini") {
        $this->ini = json_decode(\file_get_contents($config));
        $dsn = "mysql:dbname=" . $this->ini->database . ";host=" . $this->ini->host;
        $dsn = ($this->ini->port != 3306) ? $dsn : $dsn . ":" . $this->ini->port;
        $this->db = new \PDO($dsn, $this->ini->username, $this->ini->password);
        $this->db->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        $this->db->setAttribute(\PDO::MYSQL_ATTR_USE_BUFFERED_QUERY,"true");
        $this->testCRUD();
    }

    function create(array $values, string $table, string $database) {

        $db_msg = "INSERT INTO `" . $this->ini->database . "`.`$table` (";
        foreach ($values as $key => $val) {
            $db_msg .= $key . ", ";
        }

        $db_msg = substr($db_msg, 0,strlen($db_msg)-2) . ") VALUES(";
        
        foreach ($values as $key => $val) {
            if (is_numeric($val))
                $db_msg .= $val . ", ";
            else if (!is_numeric($val))
                $db_msg .= "\"" . $val . "\", ";
        }
        $db_msg = substr($db_msg, 0, strlen($db_msg)-2) . ")";
        $db_ = $this->db->prepare($db_msg);
        $db_->execute() or die(print_r($db_->errorInfo(), true));

        return 1;
    }

    function read(array $ta_ky, string $where) {

        $db_msg = "SELECT ";
        foreach ($ta_ky as $ta => $ky) {
            foreach ($ky as $key) {
                $db_msg .= "`" . $ta . "`.`$key`, ";
            }
        }
        
        $db_msg = substr($db_msg,0,strlen($db_msg)-2);
        $db_msg .= " FROM ";
        foreach ($ta_ky as $ta => $ky) {
            $db_msg .= "`$ta`, ";
            
        }
        $db_msg = substr($db_msg,0,strlen($db_msg)-2);
        $db_msg .= " WHERE $where";

        $db_ = $this->db->prepare($db_msg);
        $db_->execute() or die(print_r($db_->errorInfo(), true));
        $this->rows = $db_->fetchAll(\PDO::FETCH_BOTH);
        unset($db_);

        return $this->rows;
    }

    public function update(string $table, array $key_value, string $where) {

        $db_msg = "UPDATE $table SET ";
        foreach ($key_value as $ky => $val) {
            if (is_numeric($val))
                $db_msg .= "`$ky` = $val, ";
            else if (!is_numeric($val))
                $db_msg .= "`$ky` = \"$val\", ";
            
        }

        $db_msg = substr($db_msg,0,strlen($db_msg)-2);
        $db_msg .= " WHERE $where";
        $db_ = $this->db->prepare($db_msg);
        $db_->execute() or die(print_r($db_->errorInfo(), true));

        return 1;
    }

    public function delete(string $table, string $where) {

        $db_msg = "DELETE FROM $table WHERE $where";

        $db_ = $this->db->prepare($db_msg);
        $db_->execute() or die(print_r($db_->errorInfo(), true));

        return 1;
    }
}

$db = new db();