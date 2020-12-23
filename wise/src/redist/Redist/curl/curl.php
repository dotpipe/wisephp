<?php 

namespace wise\src\redist\Redist\curl;

use wise\src\redist\Redist\Redist;
use wise\src\redist\Redist\url\pURL;

require '../../../../../vendor/autoload.php';

class curl extends Redist implements pCURLs {

	static $content_type;
	static $handles = [];

	public static function run() {

		// begin
		$ch = self::create_multi_handler();
		// aggregate data
		foreach (purl::$users->cookie_sheet as $value) {
			$user_vars = [];
			$servers = null;
			$token = null;
			foreach ($value as $k => $v) {
				if ($k == 'server')
					$servers = $v;
				else if ($k != 'server' && $k != 'session')
					$user_vars[] = $v;
				else if ($k == 'session')
					$token = $v;
			}
			self::$handles[] = self::prepare_curl_handle($servers, $user_vars, $token);
		}

		// swarm!
		self::execute_multiple_curl_handles(self::$handles);
		file_put_contents("users.conf", "");
	}

	// For curl operations
	public static function set_content_type($type) {
		return self::$content_type = $type;
	}

	public static function create_multi_handler() {
		return curl_multi_exec();
	}

	public static function prepare_curl_handles($server, $fields, $token) {
		   
		$h = [];
		if ($server == null)
			return $h;

		$h = self::prepare_curl_handle($server, $fields, $token);
	   
		return $h;
	}

	// This is where we translate our user files into the curl call
	public static function prepare_curl_handle($server_url, $fields, $token){

		$field = [];  
		foreach ($fields as $k => $v)
			$field = array_merge($field, array($k => $v));
		$field = array_merge($field, array("token" => $token));
		$handle = curl_init($server_url);
		$user_agent=$_SERVER['HTTP_USER_AGENT'];

		curl_setopt($handle, CURLOPT_TIMEOUT, 20);
		curl_setopt($handle, CURLOPT_URL, $server_url);
		curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($handle, CURLOPT_POST, 1);
		curl_setopt($handle, CURLOPT_FOLLOWLOCATION,true);
		curl_setopt($handle, CURLOPT_POSTFIELDS, json_encode($field));
		curl_setopt($handle, CURLOPT_BINARYTRANSFER, true);
		curl_setopt($handle, CURLOPT_ENCODING, "");
		curl_setopt($handle, CURLOPT_USERAGENT, $user_agent);

		$len = strlen(json_encode($field));
		curl_setopt($handle, CURLOPT_HTTPHEADER, array(														  
			'Content-Type' => self::$content_type,
			'Content-Length' => $len
			)
		);

		$page_contents = curl_exec($handle);
		return $handle;
	}

	public static function add_handles($curl_multi_handler, $handles) {
		foreach($handles as $handle)
			curl_multi_add_handle($curl_multi_handler, $handle);
	}
   
	public static function perform_multi_exec($curl_multi_handler) {
   
		do {
			$mrc = curl_multi_exec($curl_multi_handler, $active);
		} while ($active > 0);
 
		while ($active && $mrc == CURLM_OK) {
			if (curl_multi_select($curl_multi_handler) != -1) {
				do {
					$mrc = curl_multi_exec($curl_multi_handler, $active);
				} while ($active > 0);
			}
		}
	}

	public static function perform_curl_close($curl_multi_handler, $handles) {
	   
			  // is this necessary
		foreach($handles as $handle){
			curl_multi_remove_handle($curl_multi_handler, $handle);
		}
	 
		curl_multi_close($curl_multi_handler);
	}
   
	public static function execute_multiple_curl_handles($handles) {
		$curl_multi_handler = self::create_multi_handler();
		self::add_handles($curl_multi_handler, $handles);
		self::perform_multi_exec($curl_multi_handler);
		self::perform_curl_close($curl_multi_handler, $handles);
	}
}