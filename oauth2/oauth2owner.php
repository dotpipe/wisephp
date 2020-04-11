<?php declare (strict_types = 1);

namespace Adoms\oauth2;
use Adoms\src\lib;
require_once('../vendor/autoload.php');

class OAuth2Owner {

    public $user;
    public $password;
    private $token;

    public $resource;

    // The website to grant access
    // tokens to.
    private $realm;

    /*
     *   Use Wireframe to pull pages through $resource
     *   and post them at domain facade url. User will
     *   be logged in according to OAuth2.0. All of the
     *   site will be semi-accessible. Just fill in the
     *   options of the website and internal function
     *   parameters per site necessities.
    */

    public function login(string $config, array $login_info_array, string $home_dir = "/", string $home_page = "index.php"): int {
        $password = $login_info_array['password'];
        $this->hashPassword($password);
        
        $connection = new db($config);
        $table = $login_info_array['table'];
        $username = $login_info_array['username'];
        
        $read_rows = $connection->read([
            $table => [
                "username",
                "password"
            ]
        ], "`$table`.username = '$username' AND `$table`.password = '$password'");

        return count($read_rows);
    }

    public function checkExpiry(array $login_info_array, resource $connection): bool {

        $usern = sprintf("`%1$s`.`username` = %s AND `%1$s`.`realm` = %s", $login_info_array['table'], $login_info_array['username'], $login_info_array['realm']);
        
        $read_rows = $connection->read([
            $login_info_array['table'] => [
                "expiry"
            ]
        ], $usern);

        if ($read_rows->num_rows == 1) {
            $cookie = mysqli_fetch_assoc($read_rows);
            if (time() - $cookie['expiry'] > -600) {
                $connection = new db();
                $connection->delete($login_info_array['request'],$usern);
                $this->newUserTokenizer($login_info_array, $connection);
            }
            $read_rows->close();
            return true;
        }
        else if ($read_rows->num_rows > 1) {
            echo "\nPlease contact admin with error code: 3x04f";
        }
        else {
            echo "\nLogin issue: Did you forget your password?";
        }
        $read_rows->close();
        return false;
    }

    public function newUserTokenizer(array $login_info_array, resource $connection):string {

        $this->hashPassword($login_info_array['password']);
        // Create token
        $token = \createTokenizer();
        $connection->create([
            "id" => null,
            "password" => $login_info_array['password'],
            "username" => $login_info_array['username'],
            "realm" => $login_info_array['realm'],
            "token" => $token,
            "request" => $login_info_array['request'],
            "expiry" => (time() + 36000)
        ], $login_info_array['table']);

        \setcookie("TOK", $token, 36000);
        return $token;
    }

    public function hashPassword(string &$v)
    {
        $v = \password_hash($v,PASSWORD_DEFAULT);
        $v = \password_hash($v,PASSWORD_DEFAULT);
        $v = \password_hash($v,PASSWORD_DEFAULT);
        return $v;
    }

    public function createTokenizer() {
        $bin = "";
        srand(time());
        for ($i = 0; $i < 128 ; $i++) {
            $bin <<= 1;
            $bin += \rand(0,5)%2;
        }
        return \bin2hex((string)$bin);
    }

    public function logout($login_info_array) {

        $connection = new db();
        $usern = sprintf("`%1$s`.`username` = %s AND `%1$s`.`realm` = %s", $login_info_array['table'], $login_info_array['username'], $login_info_array['realm']);
        
        $this->delete($login_info_array['table'],$usrn);
        unset($_COOKIE['TOK']);
    }

}