<?php
namespace src\chat;

use src\oauth2\CRUD;

require_once __DIR__ . '../../../../vendor/autoload.php';

class ChatBox
{
    public $crud;

    /**
     * @method __construct
     * @param none
     * 
     * New object/Load INI file
     * 
     */
    public function __construct(string $ini = "chat.ini")
    {
        $this->crud = new CRUD($ini);
    }

    /**
     * @method getConversations
     * @param MySQL connection
     * 
     * Load old conversations
     * 
     */
    public function getConversations($con)
    {
        $results = $con->query('SELECT username FROM ad_revs, chat WHERE (aim = "' . $_COOKIE['myemail'] . '" || start = "' .  $_COOKIE['myemail'] . '") && username != "' . $_COOKIE['myemail'] . '" ORDER BY last DESC') or die(mysqli_error($con));
        
        $c = [];
        
        if ($results->num_rows > 0) {
            while ($row = $results->fetch_assoc()) {
                array_push($c, $row['username']);
            }
        }
        
        $f = [];
        foreach ($c as $v) {
            array_push($f, $v);
        }
        
        $f = array_unique($f);
        echo json_encode($f);
    }
    
    /**
     * @method getconduct
     * @param MySQL connection
     * 
     * Have Column Created for conduct, being swearing or cussing "on/off"
     */
    public function getconduct($cnxn)
    {
        $results = $cnxn->query('SELECT conduct_on FROM chat WHERE filename = "' . $_COOKIE['chatfile'] . '"') or die(mysqli_error($cnxn));

        // Check if the store has conduct flag on/off
        //if ($results->num_rows == 1)
        {
            $row = $results->fetch_assoc();
            $d = $row['conduct_on'];
            echo $row['conduct_on'];
            setcookie("conductOn", $d);
        }
        //else echo 1;
    }

    /**
     * @method updateChatFile
     * @param none
     * 
     * Update Command for chat
     * Run getFileName() to get the cookie
     */
    public function updateChatFile()
    {
        $filename = $_COOKIE['chatfile'];
        //$sql = 'UPDATE chat SET chat.altered = chat.last, chat.checked = 0, last = CURRENT_TIMESTAMP WHERE filename = "' . $filename . '"';
        $this->crud->update("chat", ["altered" => "last","checked" => 0,"last" => "CURRENT_TIMESTAMP"], "filename = \" . $filename . \"");
    }
    
    /**
     * @method chatCheck
     * @param none
     * 
     * List all chats prior
     * works within chat.js
     */
    public function chatCheck()
    {
        $conn = mysqli_connect($_SESSION['host'], $_SESSION['username'], $_SESSION['password'], $_SESSION['database'], $_SESSION['port']) or die("Error: Cannot create connection");

        $results = $this->crud->read(["ad_revs" => ["alias"]], '"username = "' . $_GET['d'] . '"') or die(mysqli_error($conn));

        // get chat alias of other side (store manager)
        $c = "";
        if ($results->num_rows > 0) {
            $row = $results->fetch_assoc();
            $c = $row['alias'];
        }
        
        //
        $query_res = $this->crud->read(["chat"=>["filename"]], '((aim = "' . $_GET['d'] . '" && start = "' . $_COOKIE['myemail'] . '") || (aim = "' . $_COOKIE['myemail'] . '" && start = "' . $_GET['d'] . '"))');
        $b = "";
        if ($query_res->num_rows > 0) {
            $row = $query_res->fetch_assoc();
            $b = $row['filename'];
        } else {
            return;
        }
        
        $filename = $b;
        setcookie("chatfile", $filename);
        if (!file_exists('../chatxml/' . $filename)) {
            file_put_contents('../chatxml/' . $filename, "<?xml version='1.0'?><?xml-stylesheet type='text/xsl' href='chatxml.xsl' ?><messages></messages>");
            chmod('../chatxml/' . $filename, 0644);
        }
        
        $dom = "";
        
        $dom = simplexml_load_file("../chatxml/" . $filename);

        $v = $_GET['a'];

        $tmpy = $dom->addChild("msg");
        $tmp = $tmpy->addChild("text", $v);
        $tmpy->addAttribute("alias", $_COOKIE['myalias'] . " <-> "  . $c);
    
        $tmp->addAttribute("time", time());
        $tmp->addAttribute("user", $_COOKIE['myemail']);
        $tmp->addAttribute("alias", $_COOKIE['myalias']);
        echo $dom->asXML('../chatxml/' . $filename);

        $this->updateChatFile();
    }

    /**
     * @method flagComment
     * @param none
     * 
     * Flag user for comment
     */
    public function flagComment()
    {
        $results = $this->crud->read(["chat" => ["filename","conduct_on","id"]], '(aim = "' . $_COOKIE['myemail'] . '" && start = "' .  $_GET['d'] . '") || (aim = "' . $_GET['d'] . '" && start = "' .  $_COOKIE['myemail'] . '")');
        
        $row = [];
        
        if ($results->num_rows == 1) {
            $row = $results->fetch_assoc();
            $d[0] = $row['id'];
            echo json_encode($d[0]);
            setcookie("chatfile", $row['filename']);
            // Insert new record of banned language
            $time = date("Y-m-d H:i:s", $_GET['time']);
            echo "\n" . $row['id'] . "\n";
            $id = $d[0];
            $d[1] = $row['conduct_on'];
            $sql = array(
                    "serial" => null,
                    "chat_id" => $d[0],
                    "conduct" => $d[1],
                    "message" => $_GET['msg'],
                    "date" => $time,
                    "flagged" => 1,
                    "username" => $_GET['d']
                    );
            $results = $this->crud->create($sql, "conduct");
        }
    }
    /**
     * @method getfilename
     * @param none
     *  
     * This is used to create a COOKIE with
     * the name of the XSLT file.
     */
    public function getfilename()
    {
    
    // Retrieve filename of chat
        $results = $this->crud->read(["chat" => ["filename","id"]], '(aim = "' . $_COOKIE['myemail'] . '" && start = "' .  $_GET['d'] . '") || (aim = "' . $_GET['d'] . '" && start = "' .  $_COOKIE['myemail'] . '")');
        if ($results->num_rows == 1) {
            $row = $results->fetch_assoc();
            $d = $row['filename'];
            echo json_encode($d);
            setcookie("chatfile", $d);
        }
    }
    
    
    /**
     * @method setConduct
     * @param none
     * 
     * Turn swearing on and off
     */
    public function setconduct()
    {
        $results = $this->crud->read(["crud" => ["aim","conduct_on"]], 'filename = "'. $_COOKIE['chatfile'] . '"');
        if ($results->num_rows == 1) {
            $row = $results->fetch_assoc();
            $d = $row['conduct_on'];
        
            // Only a store can set the conduct flag
            // Stores are always the 'aim' column
            // People aren't called by stores, it's vice versa
            ($d == 1) ? $bool = 0 : $bool = 1;
            setcookie("conductOn", $bool);
            $this->crud->update("chat", ["conduct_on" => $bool], 'filename = "'. $_COOKIE['chatfile'] . '"');
        }
    }

    
    /**
     * @method newconduct
     * @param none
     * 
     * Conduct DB Columns: serial_id, chat_id, conduct_on, message, data, flagged, username
     */
    public function newconduct()
    {
        $results = $this->crud->read(["chat" => ["conduct_on", "id"]], 'aim = "' . $_COOKIE['myemail'] . '" && start = "' .  $_GET['d'] . '") || (aim = "' . $_GET['d'] . '" && start = "' .  $_COOKIE['myemail'] . '"');

        $row = [];
        
        if ($results->num_rows == 1) {
            $row = $results->fetch_assoc();
            $d[0] = $row['conduct_on'];
            if ($d[0] == 0) {
                return;
            }
            echo json_encode($d[0]);
            setcookie("chatfile", $d[0]);
            $d[1] = $row['id'];
            // Insert new record of banned language
            $sql = array(
                "serial" => null,
                "chat_id" => $d[0],
                "conduct_on" => $d[1],
                "message" => $_GET['msg'],
                "date" => date("d/M/Y H:i:s"),
                "flagged" => $d[0],
                "username" => $_GET['d']
                );
            $results = $this->crud->create($sql, "conduct");
        }
    }
    
    /**
     * @method createChat
     * @param none
     * 
     * New chat creation
     */
    public function createChat()
    {
        $results = $this->crud->read(["chat" => ["id","filename"]], 1);

        $var = [];

        // recover filenames
        while ($var = $results->fetch_assoc()) {
            if (file_exists("../chatxml/" . $var['filename'])) {
                continue;
            }
            if (!file_exists("../chatxml/" . $var['filename'])) {
                file_put_contents("../chatxml/" . $var['filename'], "<?xml version='1.0'?><?xml-stylesheet type='text/xsl' href='chatxml.xsl' ?><messages></messages>");
                chmod('../chatxml/' . $var['filename'], 0644);
            }
        }
    }
}
