<?php

namespace src\redist\Redist\url;

use src\redist\Redist\setup\pConfig;
use src\redist\Redist\files\filemngr;
use src\redist\Redist\files\file_class;


require "/../../../vendor/autoload.php";

class pURL implements pUser {

	static $ch;
	static $user;
	static $users;
	// Required in REQUEST	//
	static $server;		//
	static $fields;
	// Required in REQUEST	//
	static $session;	//
	static $handles;
	// DO NOT PUT IN REQUEST
	static $refer_by;	//
	static $relative;	//
	static $from_addr;	//
	// DO NOT PUT IN REQUEST//
	static $path_user;
	static $path_server;
	static $opt_ssl;
	static $page_contents;
	static $percent_diff;
	// Set for MAX delay in microseconds
	static $delay;
	// Set for MAX of history length of users
	static $max_history;
	static $content_type;
	static $timer;
	static $request;
	static $files;
	static $setup;
	static $method;
	static $req;
	static $hash;
	static $temp;
	static $users_per_queue;

    /**
     * @method create
     * 
	 * Create new User reference
	 * 
     */
	public static function create() {
		
		self::$files = new file_class();
		self::$setup = new pConfig();
		self::$hash = hash("sha256", $_SERVER['REMOTE_ADDR']);
		if (file_exists(self::$files->user_log_dir().self::$hash)) {
			self::$request[] = self::$files->get_user_log();

		}
		if (isset($_SERVER['HTTP_REFERER'])) {
			self::$request['session'][$_SERVER['HTTP_REFERER']]['user_addr'] = $_SERVER['REMOTE_ADDR'];
		}
		else
			self::$request['session']['direct']['user_addr'] = $_SERVER['REMOTE_ADDR'];
	// Get query string in either GET or POST
		if (isset($_SERVER['HTTP_REFERER']))
			self::$request['session'][$_SERVER['HTTP_REFERER']]['data'] = ($_SERVER['REQUEST_METHOD'] == "GET") ? ($_GET) : ($_POST);
		else {
			self::$request['session']['direct']['data'] = ($_SERVER['REQUEST_METHOD'] == "GET") ? ($_GET) : ($_POST);
			if (isset(self::$request['session']['direct']['self']) && is_int(self::$request['session'][$_SERVER['HTTP_REFERER']]['self']))
				self::$request['session']['direct']['self'] += 1;
			else
				self::$request['session']['direct']['self'] = 1;
		}
	// Let's setup the Cookie Sheets so each address is accommodated for
		if (isset($_COOKIE) && count($_COOKIE) > 0 // The target_pg, below, is for the redirtect
			&& isset($_SERVER['HTTP_REFERER'])
			&& isset(self::$request['session'][$_SERVER['HTTP_REFERER']]['target_pg'])
			&& isset($_COOKIE))
			self::$request['session'][$_SERVER['HTTP_REFERER']]['cookies'] = $_COOKIE;
			// There are a couple things we use in pUrl to look at our users //
		if (isset($_SERVER['HTTP_REFERER'])) {
			self::$request['session'][$_SERVER['HTTP_REFERER']]['refer_by'][] = $_SERVER['HTTP_REFERER'];
			self::$request['session'][$_SERVER['HTTP_REFERER']]['relative'] = [];	// 
			self::add_referer();
		}
	// This is for listing all users in the queue
		self::$users = [];
	// Default is to turn off HTTPS:// but the program figures it out itself
	// for the most part, but if you do run into trouble, just run this static function
		self::option_ssl(false);
	// Percent of equal critical data points before return in self::$users
	// Change at any time
		self::$percent_diff = 0.75;
	// microsecond delay in wave static function
		self::$delay = 1175;
		self::$max_history = 10;
		self::$timer = time();
		self::$content_type = 'application/x-www-form-urlencoded';
	}

    /**
     * @method change_user_queue_count
	 * @param count
     * 
	 * change amount of users that can be in queue
	 * during peak times. Otherwise it will cycle.
	 * 
     */
	public static function change_user_queue_count($count) {
		self::$users_per_queue = $count;
		return;
	}

    /**
     * @method trace
	 * @param var
     * 
	 * print out variable value
	 * 
     */
	public static function trace($var) {
		echo '<pre>';
		print_r($var);
	}

    /**
     * @method get_servers
     * 
	 * used in a couple constructors
	 * 
     */
	public static function get_servers() {
		if (!isset($_SERVER['HTTP_REFERER']) || !isset(self::$request['session'][$_SERVER['HTTP_REFERER']]['server']))
			return null;
		self::$server = self::$request['session'][$_SERVER['HTTP_REFERER']]['server'];
		return self::$request['session'][$_SERVER['HTTP_REFERER']]['server'];
	}

    /**
     * @method get_sessions
     * 
	 * used in a couple constructors
	 * 
     */
	public static function get_sessions() {
		if (!isset(self::$request['session'][$_SERVER['HTTP_REFERER']]))
			return null;
		return self::$request['session'][$_SERVER['HTTP_REFERER']];
	}

    /**
     * @method send_request
     * 
	 * 
	 * return the number of users present
	 * and committed to sending info of.
     */
	public static function user_count() {
		if (is_array(self::$users))
			return sizeof(self::$users);
		self::$users = [];
		return 0;
	}

    /**
     * @method validate request
	 *  
	 * make sure users gone through system
	 * 
     */
	public static function validate_request() {
		
		if (self::$request != null && sizeof(self::$request) != 1)
			return true;
		return false;
	}

    /**
     * @method send_request
     * 
	 * initialize connection to foreign server
	 * 
     */
	public static function send_request() {
		if (self::$files->find_user_queue(self::$users[0]) == false)
			return false;
		$req = [];
		self::$files->get_user_log(self::$users[0]);
		$options = [
			"http" => [
				"header" => "Content-type: " . self::$content_type,
				"method" => 'POST',
				"content" => http_build_query((array)self::$user)
			]
		];
		array_shift(self::$users);
		file_put_contents(self::$setup->path_server . "/users.conf", json_encode(self::$users));
		$context = stream_context_create($options);
		$url = self::$opt_ssl . self::$user->cookie_sheet->server;
		self::$page_contents = file_get_contents($url, false, $context);
		return true;
	}

    /**
     * @method update queue
     * 
	 * reinitialize data
	 * 
     */
	public static function update_queue() {
		
		self::$files->save_user_log(self::$request['session'][$_SERVER['HTTP_REFERER']]);
		file_put_contents(self::$setup->path_server . "/users.conf", json_encode(self::$users));
	}

    /**
     * @method disassemble_IP
	 * @param host
     * 
	 * create backfire to stop overtly multiple hits from one connection
	 * 
     */
	public static function disassemble_IP($host) {
		
		if ($host == "::1")
			return;
		preg_match("/.\//", $host, $output);
		if (is_array($output))
			echo json_encode($output);
		if ($output == null)
			return;
		$ipv4 = gethostbyname($output);
		preg_match_all("/(\d{1,3}|\.{0})/", $ipv4, $ip_pieces);
		$ip_pieces = $ip_pieces[0];
		self::$request['session'][$_SERVER['HTTP_REFERER']]['from_addr'] = [];
		self::$request['session'][$_SERVER['HTTP_REFERER']]['from_addr']['A'] = $ip_pieces[0];
		self::$request['session'][$_SERVER['HTTP_REFERER']]['from_addr']['B'] = $ip_pieces[1];
		self::$request['session'][$_SERVER['HTTP_REFERER']]['from_addr']['C'] = $ip_pieces[2];
		self::$request['session'][$_SERVER['HTTP_REFERER']]['from_addr']['D'] = $ip_pieces[3];
		self::make_relationships();
	}

    /**
     * @method make_relationships
     * 
	 * look at network traffic from above
	 * 
     */
	public static function make_relationships() {
		
		$new_relations = [];
		foreach (self::$users->cookie_sheet as $k => $v1) {
			if ($v1 != "from_addr" || $v1->cookie_sheet->session == self::$request['session'][$_SERVER['HTTP_REFERER']])
				continue;
			if (self::$request['session'][$_SERVER['HTTP_REFERER']]['from_addr']['A'] == $v1->cookie_sheet->A && self::$request['session'][$_SERVER['HTTP_REFERER']]['from_addr']['B'] == $v1->cookie_sheet->B &&
				self::$request['session'][$_SERVER['HTTP_REFERER']]['from_addr']['C'] == $v1->cookie_sheet->C)
				$new_relations[] = $v1->cookie_sheet->session;
		}
		$unique = array_unique($new_relations);
		self::$request['session'][$_SERVER['HTTP_REFERER']]['relative'] = $unique;
	}

    /**
     * @method add_referer
     * 
	 * add refering page
	 * 
     */
	public static function add_referer () {
		
		if (isset(self::$request['session'][$_SERVER['HTTP_REFERER']]['target_pg'])
			&& isset(self::$request['session'][$_SERVER['HTTP_REFERER']]['cookies'][self::$request[$_SERVER['HTTP_REFERER']]])
			&& isset($_SERVER['HTTP_REFERER']))
			self::$request['session'][$_SERVER['HTTP_REFERER']]['cookies'][self::$request[$_SERVER['HTTP_REFERER']]] = $_SERVER['HTTP_REFERER'];
		else if (isset(self::$request['session'][$_SERVER['HTTP_REFERER']]['cookies']['self']) && is_int(self::$request['session'][$_SERVER['HTTP_REFERER']]['cookies']['self']))
			self::$request['session'][$_SERVER['HTTP_REFERER']]['cookies']['self'] += 1;
		else
			self::$request['session'][$_SERVER['HTTP_REFERER']]['cookies']['self'] = 1;
		self::remove_referer();
		return true;
	}

    /**
     * @method remove_referer
     * 
	 * remove refering page
	 * 
     */
	public static function remove_referer() {
		
		if (isset(self::$request['session'][$_SERVER['HTTP_REFERER']]['refer_by']) && sizeof(self::$request['session'][$_SERVER['HTTP_REFERER']]['refer_by']) == self::$max_history)
			array_shift(self::$request['session'][$_SERVER['HTTP_REFERER']]['refer_by']);
		else
			return 0;
		return sizeof(self::$request['session'][$_SERVER['HTTP_REFERER']]['refer_by']);
	}

    /**
     * @method relative_count
     * 
	 * manifest a slow tap of users incoming
	 * 
     */
	public static function relative_count() {
		if (self::$users == null)
			self::$users = [];
		foreach (self::$users->cookie_sheet as $key => $val) {
			$x = self::return_relatives($val);
			if ($x > 50) {
				self::$timer = microtime(true);
				self::delay_connection();
				return true;
			}
		}
		return false;
	}

    /**
     * @method parse_call
     * 
	 * run through call
	 * 
     */
	public static function parse_call() {
		
		self::spoof_check();
		if (count(self::$request) == 4)
			exit();
		if (!self::match_remote_server()) {
			echo "Fatal Error: Your address is unknown";
			exit();
		}
		else if (!self::match_target_server()) {
			echo "Fatal Error: Target address unknown";
			exit();
		}
		
		$host = self::$request['session'][$_SERVER['HTTP_REFERER']]['user_addr'];
		self::disassemble_IP($host);
		self::$files->get_user_queue();
		self::$users[] = self::$request['session'][$_SERVER['HTTP_REFERER']];
		self::patch_connection();
	}

    /**
     * @method spoof_check
     * 
	 * deny access and check forlisted nad new spoof addresses
	 * 
     */
	public static function spoof_check() {
		
		if (file_exists("spoof_list"))
			$pre_spoof_filter = file_get_contents("spoof_list");
		else
			return true;
		$spoof_list = json_decode($pre_spoof_filter);
		if ($spoof_list == null)
			return true;
		if (in_array(self::$request['session'][$_SERVER['HTTP_REFERER']]['user_addr'],$spoof_list))
			exit();
	}

    /**
     * @method match_remote_server
     * 
	 * sync with incoming server
	 * 
     */
	public static function match_remote_server() {
		if (isset($_SERVER['HTTP_REFERER']) && (isset(self::$request['session'][$_SERVER['HTTP_REFERER']]['user_addr'])))
			$host = self::$request['session'][$_SERVER['HTTP_REFERER']]['user_addr'];
		else
			$host = self::$request['session']['direct']['user_addr'];

		$trim = "";
		if ($host == "::1" || str_replace("localhost","",$host) == true)
			return true;
		if (($trim = str_replace("http://","",$host) == true))
			self::option_ssl(false);
		else if (($trim = str_replace("https://","",$host) == true))
			self::option_ssl(true);
		if (filter_var($host, FILTER_VALIDATE_URL) == false
			&& ($check_addr_list = gethostbynamel($host)) == false) {
			$spoof_list[] = self::$request['session'][$_SERVER['HTTP_REFERER']]['user_addr'];
			$spoof_list = array_unique($spoof_list);
			file_put_contents("spoof_list", $spoof_list);
			return false;
		}
		return true;
	}

    /**
     * @method match_target_server
     * 
	 * find link and sync with target server
	 * 
     */
	public static function match_target_server() {
		if (isset($_SERVER['HTTP_REFERER']) && (isset(self::$request['session'][$_SERVER['HTTP_REFERER']]['data']['target_pg'])))
			$host = self::$request['session'][$_SERVER['HTTP_REFERER']]['data']['target_pg'];
		else
			$host = self::$request['session']['data']['target_pg'];
		$trim = "";
		if ($host == "::1" || str_replace("localhost","",$host) == true)
			return true;
		if (($trim = str_replace("http://","",$host) == true))
			self::option_ssl(false);
		else if (($trim = str_replace("https://","",$host) == true))
			self::option_ssl(true);
		if (filter_var($host, FILTER_VALIDATE_URL) == false
			&& ($check_addr_list = gethostbynamel($host)) == false) {
			$spoof_list[] = self::$request['session'][$_SERVER['HTTP_REFERER']]['user_addr'];
			$spoof_list = array_unique($spoof_list);
			file_put_contents("spoof_list", $spoof_list);
			return false;
		}
		return true;
	}

    /**
     * @method return_relatives
     * 
	 * Compare and find relative network traces
	 * 
     */
	public static function return_relatives($addr) {
		
		file_class::get_user_log($addr);
		$x = [];
		foreach (self::$user->cookie_sheet as $key) {
			if ($key != 'from_addr' || json_decode($key) == null)
				continue;
			if ($key->A == self::$request['session'][$_SERVER['HTTP_REFERER']]['from_addr']['A']
				&& $key->B == self::$request['session'][$_SERVER['HTTP_REFERER']]['from_addr']['B']
				&& $key->C == self::$request['session'][$_SERVER['HTTP_REFERER']]['from_addr']['C'])
				$x[] = self::make_relationships();
		}
		return $x;
	}

    /**
     * @method delay_connection
     * 
	 * wait for more users to come
	 * 
     */
	public static function delay_connection() {
		
		$x = [];
		if (sizeof(self::$users) > self::$users_per_queue) {
			if (self::relative_count() > 50) {
				self::$files->save_user_log($_SERVER['REMOTE_ADDR']);
				array_unique(self::$users);
				file_put_contents(self::$setup->path_server . "/users.conf", json_encode(self::$users));
				exit();
			}
		}
		array_unique(self::$users);
		if (self::$users[0] != self::$request['session'][$_SERVER['HTTP_REFERER']]) {
			$y = file_get_contents(self::$setup->path_server . "/users.conf");
			$x = json_decode($y);
			while ($x[0] != self::$request['session'][$_SERVER['HTTP_REFERER']] && time() - self::$timer < self::$delay) {
				$y = file_get_contents(self::$setup->path_server . "/users.conf");
				$x = json_decode($y);	
			}
			self::patch_connection();
		}
		array_splice(self::$users, array_search(self::$request['session'][$_SERVER['HTTP_REFERER']], self::$users), 1);
		self::update_queue();
		return true;
	}

    /**
     * @method patch_connection
     * 
	 * connect user to site
	 * 
     */
	public static function patch_connection() {
		
		if (sizeof(self::$users) > 0) {
			self::run_queue();
			self::$files->save_user_log($_SERVER['REMOTE_ADDR']);
			self::update_queue();
		}
		else if (isset(self::$request['session'][$_SERVER['HTTP_REFERER']])) {
			self::$files->save_user_log($_SERVER['REMOTE_ADDR']);
			if (self::$users == null)
				self::$users = [];
			file_put_contents("user_logs/users.conf", json_encode(self::$users));		
		}
		if (isset($_SERVER['HTTP_REFERER']))
			header('Location: ' . self::$opt_ssl . self::$request['session'][$_SERVER['HTTP_REFERER']]['data']['target_pg']);
		else
			header('Location: ' . self::$opt_ssl . self::$request['session']['direct']['data']['target_pg']);

	}

    /**
     * @method check_addr
     * 
	 * check address for spoofers
	 * look at address for relations
	 * 
     */
	public static function check_addr() {
		
		self::spoof_check();
		
		self::get_servers();
		
		if (!self::match_remote_server()) {
			echo "Fatal Error: Your address is unknown";
			exit();
		}
		else if (isset($_SERVER['HTTP_REFERER']) && isset(self::$request[$_SERVER['HTTP_REFERER']]) && !self::match_target_server(self::$opt_ssl . self::$request[$_SERVER['HTTP_REFERER']])) {
			echo "Fatal Error: Target address unknown";
			exit();
		}
		else if (isset($_SERVER['HTTP_REFERER'])) {
			if (!isset(self::$request['session'][$_SERVER['HTTP_REFERER']]['data']['target_pg']))
			{
				echo "Fatal Error: No target address";
				exit();
			}
		}
		else if (!isset(self::$request['session']['direct']['data']['target_pg'])) {
			echo "Fatal Error: No target Address";
			exit();	
		}
		return true;
	}
	
    /**
     * @method run_queue
     * 
	 * connect everyone to destination
	 * 
     */
	public static function run_queue() {
		if (self::$files->find_user_queue(self::$request['session'][$_SERVER['HTTP_REFERER']]) != false)
			self::send_request();
	}

    /**
     * @method send_request
     * 
	 * use detected HTTP or HTTPS protocol
	 * 
     */
	public static function option_ssl($bool) {
		self::$opt_ssl = "https://";
		if ($bool == false)
			self::$opt_ssl = "http://";
		return $bool;
	}

    /**
     * @method print_page
     * 
	 * Print page in context stream
	 * 
     */
	public static function print_page() {
		echo self::$page_contents;
	}

}