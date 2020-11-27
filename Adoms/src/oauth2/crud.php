<?php
namespace Adoms\src\oauth2;

require_once __DIR__ . '../../../../vendor/autoload.php';

class CRUD
{
    public $ini;
    public $db; // handle for database

    public function testCRUD()
    {
        $vals = array(
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
            "nums" => 1,
        );

        $database = "adrs";

        $this->create($vals, "advs", $database);

        $data_test = array(
            "advs" => array("store_name", "slogan"));

        $this->read($data_test, "`slogan` = 'much ado'");

        $this->update("advs", array("slogan" => "heyhey!"), 1);

        $this->delete("advs", 1);
    }

    public function __construct(string $config = "/Adoms/config/config.json")
    {
        $this->ini = json_decode(\file_get_contents($config));
        $dsn = "mysql:dbname=" . $this->ini->database . ";host=" . $this->ini->host;
        $dsn = ($this->ini->port == 3306) ? $dsn : $dsn . ":" . $this->ini->port;
        $this->db = new \PDO($dsn, $this->ini->username, $this->ini->password);
        $this->db->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        $this->db->setAttribute(\PDO::MYSQL_ATTR_USE_BUFFERED_QUERY, "true");
        $this->ini->password = null;
    }

    /*
    $create([
    col1 => value,
    col2 => value,
    col3 => value
    ], $table)
     */
    public function create(array $values, string $table)
    {
        $db_msg = "INSERT INTO `$table` (";
        //oreach ($values as $key => $val) {
        foreach ($values as $k => $v) {
            $db_msg .= $k . ",";
        }
        //}

        $db_msg = substr($db_msg, 0, strlen($db_msg) - 1) . ") VALUES(";

        //foreach ($values as $key => $val) {
        foreach ($values as $k => $v) {
            if (!is_string($v) && !\is_numeric($v)) {
                $db_msg .= "NULL,";
            } elseif (is_string($v)) {
                $db_msg .= "'" . $v . "',";
            } else {
                $db_msg .= $v . ",";
            }
        }
        //}
        $db_msg = substr($db_msg, 0, strlen($db_msg) - 1) . ")";
        $db_ = $this->db->prepare($db_msg);
        echo $db_msg;
        $db_->execute() or die(print_r($db_->errorInfo(), true));

        return 1;
    }

    /*
    Use instruction:
    $read([
    $table1 => [
    col1,
    col2,
    col3,
    ...,
    coln
    ]
    ], $where)
     */

    public function read(array $ta_ky, string $where)
    {
        $db_msg = "SELECT ";

        foreach ($ta_ky as $ta => $ky) {
            foreach ($ky as $key) {
                $db_msg .= "`" . $ta . "`.`$key`,";
            }
        }

        $db_msg = substr($db_msg, 0, strlen($db_msg) - 1);
        $db_msg .= " FROM ";
        foreach ($ta_ky as $ta => $ky) {
            $db_msg .= "`$ta`, ";
        }
        $db_msg = substr($db_msg, 0, strlen($db_msg) - 2);
        $db_msg .= " WHERE $where";

        $db_ = $this->db->prepare($db_msg);
        $db_->execute() or die(print_r($db_->errorInfo(), true));
        $this->rows = $db_->fetchAll(\PDO::FETCH_BOTH);
        unset($db_);

        return $this->rows;
    }

    /*
    Use:
    $update(
    $table,
    [
    key1 => value,
    key2 => value
    ],
    $where
    )
     */
    public function update(string $table, array $key_value, string $where)
    {
        $db_msg = "UPDATE $table SET ";
        foreach ($key_value as $ky => $val) {
            if (is_numeric($val)) {
                $db_msg .= "`$table`.`$ky` = $val, ";
            } elseif (!is_numeric($val)) {
                $db_msg .= "`$table`.`$ky` = \"$val\", ";
            }
        }
        $db_msg = substr($db_msg, 0, strlen($db_msg) - 2);
        $db_msg .= " WHERE $where";
        $db_ = $this->db->prepare($db_msg);
        $db_->execute() or die(print_r($db_->errorInfo(), true));

        return 1;
    }

    /*
    $delete($table,$where)
     */
    public function delete(string $table, string $where)
    {
        $db_msg = "DELETE FROM $table WHERE $where";

        $db_ = $this->db->prepare($db_msg);
        $db_->execute() or die(print_r($db_->errorInfo(), true));

        return 1;
    }
}

//$db = new crud();
