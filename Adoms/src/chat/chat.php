<?php

include_once("/vendor/autoload.php");

// Update
function updateChatFile($con) {
    $filename = $_COOKIE['chatfile'];
    $sql = 'UPDATE chat SET chat.altered = chat.last, chat.checked = 0, last = CURRENT_TIMESTAMP WHERE filename = "' . $filename . '"';
    $results = $con->query($sql);
}

$conn = mysqli_connect($_SESSION['host'], $_SESSION['username'], $_SESSION['password'], $_SESSION['database'], $_SESSION['port']) or die("Error: Cannot create connection");

    $results = $conn->query('SELECT alias FROM ad_revs WHERE username = "' . $_GET['d'] . '"') or die(mysqli_error($conn));
    
    // get chat alias of other side (store manager)
    $c = "";
    if ($results->num_rows > 0) {
        $row = $results->fetch_assoc();
        $c = $row['alias'];
    }
    
    // 
    $query_res = $conn->query('SELECT filename FROM chat WHERE ((aim = "' . $_GET['d'] . '" && start = "' . $_COOKIE['myemail'] . '") || (aim = "' . $_COOKIE['myemail'] . '" && start = "' . $_GET['d'] . '"))') or die(mysqli_error($conn));
    $b = "";
    if ($query_res->num_rows > 0) {
        $row = $query_res->fetch_assoc();
        $b = $row['filename'];
    }
    else
        return;
    $filename = $b;
    setcookie("chatfile",$filename);
    if (!file_exists('../chatxml/' . $filename)) {
        file_put_contents('../chatxml/' . $filename, "<?xml version='1.0'?><?xml-stylesheet type='text/xsl' href='chatxml.xsl' ?><messages></messages>");
        chmod('../chatxml/' . $filename, 0644);
    }
    
    $dom = "";
    
    $dom = simplexml_load_file("../chatxml/" . $filename);

    $x = $dom->messages;
    $v = $_GET['a'];
    $n = "";

    $tmpy = $dom->addChild("msg");
    $tmp = $tmpy->addChild("text",$v);
    $tmpy->addAttribute("alias", $_COOKIE['myalias'] . " <-> "  . $c);
  
    $tmp->addAttribute("time", time());
    $tmp->addAttribute("user", $_COOKIE['myemail']);
    $tmp->addAttribute("alias", $_COOKIE['myalias']);
    echo $dom->asXML('../chatxml/' . $filename);

   updateChatFile($conn);

?>