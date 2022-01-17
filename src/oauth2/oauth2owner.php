<?php declare(strict_types = 1);

namespace src\oauth2;

require_once(__DIR__."/../../../vendor/autoload.php");

class OAuth2Owner
{
    public $user;
    public $password;
    public $token;

    public $resource;

    // The website to grant access
    // tokens to.
    public $realm;

    /** 
     * @method login
     * @param ini_for_crud
     * @param login_api_array
     * 
     *   Use Wireframe to pull pages through $resource
     *   and post them at domain facade url. User will
     *   be logged in according to OAuth2.0. All of the
     *   site will be semi-accessible. Just fill in the
     *   options of the website and internal function
     *   parameters per site necessities.
     */

    public function login(string $config, array $login_info_array): int
    {
        $password = $login_info_array['password'];
        $this->hashPassword($password);
        
        $connection = new CRUD($config);
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

    /**
     * @method checkExpiry
     * @param values
     * @param MySQL connection
     * 
     * has authorization come to end
     */
    public function checkExpiry(array $login_info_array, $connection): bool
    {
        $usern = sprintf("`%1`.`username` = %2 AND `%1`.`realm` = %3", $login_info_array['table'], $login_info_array['username'], $login_info_array['realm']);
        
        $read_rows = $connection->read([
            $login_info_array['table'] => [
                "expiry"
            ]
        ], $usern);

        if ($read_rows->num_rows == 1) {
            $cookie = mysqli_fetch_assoc($read_rows);
            if (time() - $cookie['expiry'] > -600) {
                $connection = new crud();
                $connection->delete($login_info_array['request'], $usern);
                $this->newUserTokenizer($login_info_array, $connection);
            }
            $read_rows->close();
            return true;
        } elseif ($read_rows->num_rows > 1) {
            echo "\nPlease contact admin with error code: 3x04f";
        } else {
            echo "\nLogin issue: Did you forget your password?";
        }
        $read_rows->close();
        return false;
    }

    /**
     * @method newUserTokenizer
     * @param values
     * @param MySQL connection
     * 
     * New OAuth2.0 user
     */
    public function newUserTokenizer(array $login_info_array, $connection):string
    {
        $this->hashPassword($login_info_array['password']);
        // Create token
        $token = $this->createTokenizer();
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

    /**
     * @method hashPassword
     * @param password
     * 
     * Hash password
     */
    public function hashPassword(string &$v)
    {
        $v = \password_hash($v, PASSWORD_DEFAULT);
        $v = \password_hash($v, PASSWORD_DEFAULT);
        $v = \password_hash($v, PASSWORD_DEFAULT);
        return $v;
    }

    /**
     * @method createTokenizer
     * @param none
     * 
     * create hex token for user
     */
    public function createTokenizer()
    {
        $bin = "";
        srand(time());
        for ($i = 0; $i < 128 ; $i++) {
            $bin <<= 1;
            $bin += \rand(0, 2)%2;
        }
        return \bin2hex((string)$bin);
    }

    /**
     * @method logout
     * @param values
     * 
     * 
     */
    public function logout($login_info_array)
    {
        $usern = sprintf("`%1`.`username` = %2 AND `%1`.`realm` = %3", $login_info_array['table'], $login_info_array['username'], $login_info_array['realm']);
        
        $this->connection->delete($login_info_array['table'], $usern);
        unset($_COOKIE['TOK']);
    }
}
