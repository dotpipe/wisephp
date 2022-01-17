<?php

namespace src\oauth2;

use src\pasm;

require_once(__DIR__."/../../../vendor/autoload.php");

class UserClass extends CRUD {

    /**
     * The art of routing is comparative to its own state of functioning.
     * There is a surrogate connection. It quietly chooses the direct path.
     * It does also create the inside walls of a copacetic network. One which
     * is offset from a larger web. These internal gadgets are what we get
     * from holding connections in their surrogate form. We are berthing
     * the state of an annal concluding to the cache. Here and therein, we
     * setup a great choosing from the forms of loadtimes, concurrency, threading
     * and other essential states of meta in the system. To break it down,
     * we need to make a network that consists of many channels. And it needs
     * to have administrative, group, and user identifying characteristics.
     * So we'll see what we can come up with here in this PASM coded router.
     * What don't you think I'll come upon?
     * 
     */

    public $login_cntr = 0;
    public $pasm;
    public $group_id = 0;
    public $user_id = null;
    public $GET;
    public $cmd;


    /**
     * @method __construct
     * @param none
     * 
     * Start up new user class
     */
    function __construct() {
        $this->pasm = new \src\pasm\PASM();
        $this->cmd = (isset($_GET) && isset($_GET['cmd'])) ? $_GET['cmd'] : $_POST['cmd'];
        $this->GET = (isset($_GET) && isset($_GET['cmd'])) ? $_GET : $_POST;
        if (!isset($this->GET['cmd']))
        {}
        else if ($this->cmd == 'save_user_state'
            || $this->cmd == 'load_user_state')
            $this->cmd($this->GET['file']);
        else if ($this->cmd == 'login_user')
            $this->cmd([$this->GET['user_id'],$this->GET['password']]);
        else if ($this->cmd == 'create_new_admin')
            $this->cmd([$this->GET['user_id'],$this->GET['password']]);
        else if ($this->cmd == 'new_user')
            $this->cmd([$this->GET['user_id'],$this->GET['password'],$this->GET['group_id']]);
    }

    /**
     * @method save_user_state
     * @param filename
     * 
     * I/O
     */
    protected function save_user_state($filename) {
        file_put_contents($filename,serialize($this));
        return new static;
    }

    /**
     * @method load_user_state
     * @param filename
     * 
     * I/O
     */
    public function load_user_state($filename) {
        $fx = unserialize(file_get_contents($filename));
        foreach ($fx as $key => $value)
        {
            $this->$key = $value;
            foreach ($value as $val_n)
            {
                $this->$key->$value = $val_n;
            }
        }
        return new static;
    }

    /**
     * @method login_user
     * @param values
     * @param WHERE_CLAUSE
     * 
     * I/O
     */
    public function login_user(array $login_arr, string $where)
    {
        if (isset($_COOKIE['logins']) && $_COOKIE['logins'] > 2)
            return new static;
        $crud = new CRUD();
        $rows = $crud->read($login_arr, $where);
        if (count($rows) == 1)
        {
            $this->login_cntr = 0;
            $this->group_id = $this->sp[2];
            $this->user_id = $this->sp[0];
            return new static;
        }
        if (isset($_COOKIE['logins']) && $_COOKIE['logins'] > 0)
        setcookie('logins', $this->login_cntr + 1, time() + (60 * 60 * 24 * 3));

        return false;
    }

    /**
     * @method create_new_admin
     * @param values
     * @param tablename
     * 
     * Start with new admin
     */
    protected function create_new_admin(array $user_settings_for_database, $table_name) 
    {
        $crud = new CRUD();
        $this->pasm->addr($user_settings_for_database, $table_name) // describe new array
            ->movr() // push array (r) onto stack and empty
            ->end(); // End line of used functions
        $crud->create($this->ST0, $table_name);
        return new static;
    }
    
    /**
     * @method new_user
     * @param userID
     * @param password
     * @param groupID
     * 
     * Input NULL for current user to change password.
     * Creates new users. If accessor's GUID is 0, it'll work anyway
     * We just change the password otherwise.
     * 
     */
    public function new_user(string $userId, string $password, int $groupId = 0)
    {
        $crud = new crud();
        $this->array = ["users" => []];
        if ($this->group_id == 0)
            $this->pasm->addr([$userId, $password, $groupId]);
        else if (($userId == null || $this->user_id == $userId) && $groupId == $this->group_id)
            $this->pasm->addr([$this->user_id, $password, $this->group_id]);
        $this->pasm->movr();
        $crud->create($this->ST0, $this->pasm->arr);
        $this->pasm->end();
        return new static;
    }
}