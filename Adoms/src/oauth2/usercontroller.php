<?php

namespace Adoms\src\oauth2;

use Adoms\src\crud;

class userController extends OAuth2Owner {

    public function newUser(string $userdb_ini, array $login_credentials, string $table) {

        $connection = new db($userdb_ini);

        $login_credentials['password'] = \password_hash($login_credentials['password'],PASSWORD_BCRYPT);

        if (!$connection)
            return false;

        $connection->create($login_credentials, $table);

        return true;
    }

    public function deleteUser(string $userdb_ini, string $table, string $where) {

        $connection = new db($userdb_ini);

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

        $connection = new db($userdb_ini);

        $credentials['password'] = \password_hash($credentials['password'],PASSWORD_BCRYPT);

        if (!$connection)
            return false;

        $connection->update($table, $credentials, $where);

        return true;
    }
}