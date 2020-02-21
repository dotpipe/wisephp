<?php

namespace Adoms\src\oauth2;

use Adoms\src\crud;

class userController {

    public function newUser(string $userdb_ini, array $login_credentials, string $table) {

        $connection = new CRUD($userdb_ini);

        if (!$connection)
            return false;

        $connection->create($login_credentials, $table);

        return true;
    }

    public function deleteUser(string $userdb_ini, string $table, string $where) {

        $connection = new CRUD($userdb_ini);

        if (!$connection)
            return false;

        $connection->delete($table, $where);

        return true;
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
        );
    */
    public function newUserPass(string $userdb_ini, array $credentials, string $table, string $where) {

        $connection = new CRUD($userdb_ini);

        if (!$connection)
            return false;
            
        $connection->update($table, $credentials, $where);

        return true;
    }
}