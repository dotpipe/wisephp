<?php

namespace src\oauth2;

require_once(__DIR__."/../../../vendor/autoload.php");

class userController extends OAuth2Owner
{
    
    /**
     * @method newUserPass
     * @param inifile
     * @param credentials array
     * @param table
     * 
     * Create user in database
     */
    public function newUser(string $userdb_ini, array $login_credentials, string $table)
    {
        $connection = new crud($userdb_ini);
        
        if (!$connection) {
            return false;
        }

        $this->hashPassword($login_credentials['password']);


        $connection->create($login_credentials, $table);

        return true;
    }

    
    /**
     * @method deleteUser
     * @param inifile
     * @param table
     * @param whereclause
     * 
     * Deletes row from from User database
     */
    public function deleteUser(string $userdb_ini, string $table, string $where)
    {
        $connection = new crud($userdb_ini);

        if (!$connection) {
            return false;
        }

        $connection->delete($table, $where);

        return true;
    }

    /**
     * @method newUserPass
     * @param inifile
     * @param credentials
     * @param table
     * @param whereclause
     * 
     * Use:
     * $update(
     *      $table,
     *      [
     *          key1 => value,
     *          key2 => value
     *      ],
     *      $where
     *  );
     */
    public function newUserPass(string $userdb_ini, array $credentials, string $table, string $where)
    {
        $connection = new crud($userdb_ini);

        $this->hashPassword($credentials['password']);

        if (!$connection) {
            return false;
        }

        $connection->update($table, $credentials, $where);

        return true;
    }
}
