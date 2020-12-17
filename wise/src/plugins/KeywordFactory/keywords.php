<?php declare (strict_types = 1);

namespace wise\src\lib;

require_once __DIR__ . '../../../../../vendor/autoload.php';
class KeywordFactory {

    public function insertKeyDef() {
        $ini = json_decode(file_get_contents("../../config.ini"));
        $conn = mysqli_connect($ini->host, $ini->username, $ini->password, $ini->database, $ini->port);
        
        $sql = 'INSERT INTO keywords(id,keyword,definition,username) VALUES(null,"' . $_GET['a'] . '", "' . $_GET['c']. '","' . $_COOKIE['myemail'] . '")';

        $results = $conn->query($sql) or die(mysqli_error($conn));
        
    }

    public function lookupKeyword() {

        $ini = json_decode(file_get_contents("../../config.ini"));
        $conn = mysqli_connect($ini->host, $ini->username, $ini->password, $ini->database, $ini->port);
        
        $sql = 'SELECT keyword, definition FROM keywords WHERE keyword LIKE "' . $_GET['str'] . '%" ORDER BY keyword ASC';
        
        $results = $conn->query($sql) or die(mysqli_error($conn));
        
        $i = 0;
        if ($results->num_rows === 0)
            return;
        $form = "";
        while ($i < 2 && $row = $results->fetch_assoc()) {
            $form .= '<div onclick="choseKeyword(\'' . $row['keyword'] . '\');this.parentNode.removeChild(this);" style="width:130px;display:table-cell;padding:10px;margin:10px;border-radius:25px;border:2px dashes white;background:black;">';
            $form .= '<b style="
            
            
            font-size:14px">' . $row['keyword'] . '</b><br>';
            $form .= '<i><font style="width:90px;font-size:11px">' . $row['definition'] . '</font></i>';
            $form .= '</div>';
            $i++;
        }
        $form .= '</div>';
        echo $form;
    }
}
?>