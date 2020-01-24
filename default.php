<?php declare (strict_types = 1);
file_put_contents("example.txt",":):):):)");
?>
<script src="src/routes/pipes.js"></script>
<span id="hed" style="width:100%"><br>
Pipes demonstration - <a href="http://www.github.com/swatchphp">GitHub</a> +
<a id="wiki-link" method="GET" insert-in="red" ajax="example.txt">Wiki</a> +
<i style="color:white" id="donate" redirect="follow" method="POST" goto="https://www.paypal.com/cgi-bin/webscr"> Donate + </button></i>
<input type="hidden" pipe="donate" class="data-pipe" name="cmd" value="_s-xclick" />
<input type="hidden" pipe="donate" class="data-pipe" name="hosted_button_id" value="TMZJ4ZGG84ACL" />
<input type="hidden" pipe="donate" class="data-pipe" name="source" value="url" />
<a pipe="wiki-link" class="data-pipe" name="me" value="mailto:inland14@live.com">Contact</a> +
<a pipe="wiki-link" class="data-pipe" name="ops" value="hey" href="mailto:inland14@live.com">Bug Report</a>

// the out-pipe attribute comes to here
 <b id="red"></b>
</span>
<button id="donate" redirect="follow" method="POST" goto="https://www.paypal.com/cgi-bin/webscr">Submit</button>
</p>