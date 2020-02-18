<?php
// Sidebar for Cheri
$Cheri = '<javascript src="Cheri.js"></javascript>';
$Cheri .= '<div id="startCheri" loaded="0"><h3 style="color:wine">Menu</h3>';
$Cheri .= '<table style="border:1px solid black;padding:3px;spacing:0px;width:250px;">';
$Cheri .= '<tr><td><select id="Cheriters" onclick="listConvo()" onchange="getOption(this)"><option default value="" label="Click To see Cheris waiting"></select></td>';
$Cheri .= '<td><button onclick=\'setConduct(this)\' style="border-radius:50%;color:green">&check;</button></td></tr></table>';
$Cheri .= '<div id="Cheripane">';
$Cheri .= '<table>';
$Cheri .= '<tr><td><b id="contact" style="font-size:15px;color:wine">Cheri</b> : : </td></tr>';
$Cheri .= '<tr><td colspan=2 style="background:white;border:0px;height:300px;width:250px"><div id="in-window" style="border:2px solid darkblue;overflow-wrap:break-word;overflow-y:scroll;color:white;background:white;height:300px;width:250px">';
$Cheri .= '</div></td></tr></table>';
$Cheri .= '</div>';

echo $Cheri;
?> 