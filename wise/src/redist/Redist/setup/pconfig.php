<?php

/*
 *  Redist is a distributional redirect
 *  system for servers to convert clicks
 *  into information at a central node.
 *  These cookies are saved at the root
 *  node. Each user is connected to the
 *  system with a redirect to this script.
 *  Then it is verified, to authenticate
 *  its source, and where it's going. 
 *  Many things, including SaaS can be
 *  done through this script. It is low
 *  in difficulty for server time to manage.
 *  Also, there is a DoS flood attack
 *  protection scheme in it. A queue is
 *  available to hold onto bandwidth until
 *  the server is readied to handle a new
 *  set of users to be distributed to the
 *  site they are waiting for. This all
 *  happens in microseconds. There is more
 *  as well. Read through the files and
 *  there will be an explanation on everything.
 *  
 *  This trait of Redist is to create
 *  a simple directory structure. The
 *  files that wil be kept in it are
 *  server logs, user files, and a
 *  spoof list of fake IPs, which is
 *  checked against each time a new
 *  connection is received.
 * 
*/

namespace wise\src\redist\Redist\setup;


// use wise\src\redist\Redist\search\search_methods;

require "../../../../vendor/autoload.php";

class pConfig {

	static $path_user;
	static $path_server;

	function __construct() {
	// Default Directories and files for configuation in pUrl	//
		self::$path_user = "user_logs";			//
		self::$path_server = "server_logs";			//
		if (!is_dir(self::$path_user))				//
			mkdir(self::$path_user);			//
		if (!is_dir(self::$path_server))			//
			mkdir(self::$path_server);			//
		if (!file_exists(self::$path_server . "/spoof_list"))				//
			touch(self::$path_server . "/spoof_list");				//
		if (!file_exists(self::$path_server . "/users.conf"))				//
			touch(self::$path_server . "/users.conf");				//
	}

}