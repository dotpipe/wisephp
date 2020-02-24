<?php declare (strict_types = 1);

namespace Adoms\src\OAuth2;
use Adoms\src\lib;
use Adoms\src\crud;

include '/vendor/autoload.php';

class OAuth2Owner {

    public $user;
    private $password;
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

    public function login(array $login_info_array, string $home_dir = "/", string $home_page = "index.php"): void {

        $this->hashPassword($login_info_array['password']);
        
        $connection = new db();
        
        $usern = sprintf("`%1$s`.`username` = %s AND `%1$s`.`realm` = %s", $login_info_array['table'], $login_info_array['username'],$_COOKIE['TOK'], $login_info_array['realm']);
        

        $read_rows = $connection->read([
            $login_info_array['table'] => [
                "username",
                "password"
            ]
        ], $usern);
        
        if ($read_rows->num_rows != 1)
            header("",true,500);
        foreach (mysqli_fetch_assoc($read_rows) as $k => $v) {
            if ($k == "password" && $v == $login_info_array['password'])
            {
                $this->checkExpiry($login_info_array, $connection);
                unset($login_info_array['password']);
                $connection->close();
                header("Location: $home_dir/$home_page");
            }
        }
        $connection->close();
        header("",true,500);
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
            "request" => $login_info_array['request'],
            "username" => $login_info_array['username'],
            "realm" => $login_info_array['realm'],
            "token" => $token,
            "expiry" => (time() + 36000)
        ], $login_info_array['table']);

        \setcookie("TOK", $token, 36000);
        return $token;
    }

    private function hashPassword(string &$v)
    {
        $v = \password_hash($v,PASSWORD_DEFAULT);
        return $v;
    }

    private function createTokenizer() {
        $bin = "";
        for ($i = 0; $i < 128 ; $i++) {
            $bin .= (string)(\rand(0,1));
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