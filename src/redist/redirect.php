<?php
header('Content-Type: text/html'); //application/x-www-form-urlencoded');

$_SESSION = $_POST;
echo json_encode($_POST);
touch("./blank.txt");
if (sizeof($_POST) > 0)
	file_put_contents("./blank.txt", json_encode($_POST));
?>

<a href="./redist.php?target_pg=localhost/wise/wise/src/redist/pipes_demo.php&email=user@mail.com&session=hsgakiiuijt3ghvfjl5l5hd2fi">?asaf</a>