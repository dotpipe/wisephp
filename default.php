<?php
file_put_contents("example.txt",":):):):)");
echo "<script src=\"src/routes/pipes.js\"></script>";
echo "<span id=\"hed\" style=\"width:100%\"><br>";
echo "Pipes demonstration - <a href=\"http://www.github.com/swatchphp\">GitHub</a> + ";
echo "<a id=\"wiki-link\" method=\"GET\" insert-in='red' ajax=\"example.txt\">Wiki</a> + ";
echo "<a id=\"donate\" redirect=\"follow\" method=\"POST\" goto=\"https://www.paypal.com/cgi-bin/webscr\"> Donate + </button>"; //?cmd=_s-xclick&hosted_button_id=TMZJ4ZGG84ACL\">Donate</a> + ";
echo "<input type=\"hidden\" pipe=\"donate\" class=\"data-pipe\" name=\"cmd\" value=\"_s-xclick\" />";
echo "<input type=\"hidden\" pipe=\"donate\" class=\"data-pipe\" name=\"hosted_button_id\" value=\"TMZJ4ZGG84ACL\" />";
echo "<input type=\"hidden\" pipe=\"donate\" class=\"data-pipe\" name=\"source\" value=\"url\" />";
echo "<a pipe=\"wiki-link\" class=\"data-pipe\" name=\"me\" value=\"mailto:inland14@live.com\">Contact</a> + ";
echo "<a pipe=\"wiki-link\" class=\"data-pipe\" name=\"ops\" value=\"hey\" href=\"mailto:inland14@live.com\">Bug Report</a>";

// the out-pipe attribute comes to here
echo " <b id='red'></b>";
echo "</span>";
echo "<button id=\"donate\" redirect=\"follow\" method=\"POST\" goto=\"https://www.paypal.com/cgi-bin/webscr\">Submit</button>";
echo "</p>";