<?php
include_once("/vendor/autoload.php");

// Sidebar for chat
$chat = '<javascript src="chat.js"></javascript>';
$chat .= '<div id="startchat" loaded="0"><h3 style="color:wine">Menu</h3>';
$chat .= '<table style="border:1px solid black;padding:3px;spacing:0px;width:250px;">';
$chat .= '<tr><td><select id="chatters" onclick="listConvo()" onchange="getOption(this)"><option default value="" label="Click To see chats waiting"></select></td>';
$chat .= '<td><button onclick=\'setConduct(this)\' style="border-radius:50%;color:green">&check;</button></td></tr></table>';
$chat .= '<div id="chatpane">';
$chat .= '<table>';
$chat .= '<tr><td><b id="contact" style="font-size:15px;color:wine">Chat</b> : : </td></tr>';
$chat .= '<tr><td colspan=2 style="background:white;border:0px;height:300px;width:250px"><div id="in-window" style="border:2px solid darkblue;overflow-wrap:break-word;overflow-y:scroll;color:white;background:white;height:300px;width:250px">';
$chat .= '</div></td></tr></table>';
$chat .= '</div>';

echo $chat;
?> 