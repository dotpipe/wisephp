<?php
// Send appropriate mime type
header("Content-Type: text/event-stream\n\n");

// Infinite loops to encourage updating automatic chat displays
do {
	echo "event: message\n",
	    'data: {}';
	echo "\n\n";
	ob_flush();
	flush();
	if ( connection_aborted() ) break;
	sleep( rand(7, 13) );
} while (1);

?>