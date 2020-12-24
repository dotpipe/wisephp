<?php

namespace wise\src\Redist\redist;

use wise\src\redist\Redist\setup\pConfig;
use wise\src\redist\Redist\search_methods;
use wise\src\redist\Redist\files\file_class;
use wise\src\redist\Redist\url\pURL;
use wise\src\redist\Redist\curl\curl;
require '../../../vendor/autoload.php';

class Redist {

	static $files;
	static $curl;
	static $search;
	static $url;
	static $request;
	static $setup;

	/**
	 * @method instance
	 * @param none
	 * 
	 * Run this to start the ball rolling
	 * 
	 */
    public static function instance() {
		self::$setup = new pConfig();
		self::$search = new search_methods();
		self::$files = new file_class();
		self::$url = new pURL();
		self::$curl = new cURL();
		self::$url->create();
		self::parse_call();
    }

	/**
	 * @method parse_call
	 * @param none
	 * 
	 * Create connection or disconnect
	 */
	public static function parse_call() {

		self::$url->check_addr();

		$host = $_SERVER['REMOTE_ADDR'];
		self::$url->disassemble_IP($host);
		
		self::$files->get_user_queue();
		
		self::$url->get_sessions();

		self::$url->patch_connection();

	}

	/**
	 * @method detail_scrape
	 * @param none
	 * 
	 * 
	 * This scrapes for information from all users at once
	 * If self::$percent_diff == 0.75 && a user is that close
	 * to the user being scraped for, then that user will
	 * be used, along any others that meet the description
	 * compared to self::$percent_diff
 	 */
	public static function detail_scrape() {
		$search = [];
		foreach (self::$url->users->cookie_sheet as $value) {
			if (!file_exists(self::$files->path_user.$value) || filesize(self::$files->path_user.$value) == 0 || $value == "." || $value == "..")
				continue;
			self::$files->get_user_log($value);
			$x = 0;
			$y = sizeof((array)self::$url->user) + sizeof((array)self::$url->user->cookie_sheet->refer_by) + sizeof((array)self::$url->user->cookie_sheet->from_addr);
			foreach (self::$request as $k=>$v) {
                if($k == 'from_addr') {
					if (sizeof(array_intersect($k, (array)self::$url->user->cookie_sheet->$k)) > 2)
                        $x += 1;
                }
				else if (is_array($k) || is_object($k))
					$x += sizeof(array_intersect($v, (array)self::$url->user->cookie_sheet->$k));
				else if (self::$request['cookie_sheet'][$k] == self::$url->user->cookie_sheet->$k && $x++)
					continue;
			}
			if ($x/$y > self::$url->percent_diff)
				$search[] = array($x => self::$url->user->cookie_sheet->session);
		}
		return $search;
	}
    
}

if (!isset($_SESSION))
	session_start();
//if (!isset($_COOKIE['token']) || $_COOKIE['PHPSESSID'] != $_COOKIE['token'])
//    setcookie("token", null, time() - 3600);
//setcookie("token", $_COOKIE['PHPSESSID'], time() + (86400 * 365), "/");

$handler = new Redist();
$handler->instance();
/**
*	To run the curl type;
*
*	$handler->files->update_queue();
*	if ($handler->url->user_count() > $x)
*		$handler->curl->run();
*
*/

/**
*	To run with single calls
*	
*	$handler->url->parse_call();
*	$handler->url->print_page();
*	echo '<script type="text/javascript">self.location = "' . $handler->url->opt_ssl . $handler->url->request["server"] . '"</script>';
*
*/