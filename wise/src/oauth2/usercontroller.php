<?php

namespace wise\src\oauth2;

require_once __DIR__ . '../../../../vendor/autoload.php';

class userController extends OAuth2Owner {

    public function newUser(string $userdb_ini, array $login_credentials, string $table) {

        $connection = new crud($userdb_ini);
        $this->hashPassword($login_credentials['password']);

        if (!$connection)
            return false;

        $connection->create($login_credentials, $table);

        return true;
    }

    public function deleteUser(string $userdb_ini, string $table, string $where) {

        $connection = new crud($userdb_ini);

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

        $connection = new crud($userdb_ini);

        $this->hashPassword($credentials['password']);

        if (!$connection)
            return false;

        $connection->update($table, $credentials, $where);

        return true;
    }
}