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
 *  This has the function list of the
 *  entire purl.php script.
 * 
*/

namespace wise\src\redist\Redist\url;

interface pUser {

	// Validate incoming or outgoing address
	public static function spoof_check();
	// Trace variable content
	public static function trace($var);
	// Return closest addresses for analysis
	public static function return_relatives($addr);
	// The only function completely necessary.
	// Begins all transactions except for the
	// cURL ones.
	public static function parse_call();
	// Dissolves duplicate calls, and 
	// sends to patching if count(self::$users) > 2000
	// in the queue
	public static function delay_connection();
	// Validate their is a REQUEST in the query
	// string
	public static function validate_request();
	// Create action to disperse earliest
	// user connected to their desired destination
	public static function send_request();
	// Checks spoofing, adds user to queue
	// runs patch_connection
	public static function patch_connection();
	// Check for valid incoming $host
	public static function match_remote_server();
	// Check for valid outgoing $host
	public static function match_target_server();
	// Turn SSL flag on and off
	public static function option_ssl($bool);
	// pass query string and return &server=value
	public static function get_servers();
	// pass query string and return &session=value
	public static function get_sessions();
	// count(self::$users)
	public static function user_count();
	// Add user to the queue
	public static function update_queue();
	// Make info count of who has been
	// going through the system. Images taken by IP block
	public static function disassemble_IP($host);
	// Find out if a new ABC block has come in to the
	// network.
	public static function make_relationships();
	// Checks for new refering site
//	public static function add_referer();
	// Checks refer history for max size
	public static function remove_referer();
	// Returns users who have come from same ABC blocks
	public static function relative_count();

}