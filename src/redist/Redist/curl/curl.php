<?php 

namespace src\redist\Redist\curl;

use src\redist\Redist\Redist;
use src\redist\Redist\url\pURL;

require '../../../../../vendor/autoload.php';

class cURL extends Redist implements pCURLs {

	static $content_type;
	static $handles = [];
	static $mh;

	
    /**
     * @method run
     * @param none
     * 
     * begin cURL multicast
     */
	public static function run() {

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

		self::create_multi_handler();
		// swarm!
		self::execute_multiple_curl_handles();
		file_put_contents("users.conf", "");
	}

    /**
     * @method set_content_type
     * @param $content_type
     * 
     * sets content type in header
     */
	public static function set_content_type($type) {
		return self::$content_type = $type;
	}

    /**
     * @method create_multi_handler
     * @param none
     * 
	 * add handles to multicast
     */
	public static function create_multi_handler() {
		return self::add_handles();
	}

    /**
     * @method prepare_curl_handles
     * @param none
     * 
     * proxy to prepare_curl_handle
     */
	public static function prepare_curl_handles($server, $fields, $token) {

		$h = [];
		if ($server == null)
			return $h;

		$h = self::prepare_curl_handle($server, $fields, $token);
	   
		return $h;
	}

    /**
     * @method prepare_curl_handle
     * @param server_url
	 * @param fields
	 * @param token
     * 
     * This is where we translate our user files into the curl call
	 * 
     */
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

    /**
     * @method add_handles
	 * @param null
     * 
     * here we bind all channels into one multicast resource
	 * 
     */
	public static function add_handles() {
		$mh = curl_multi_init();
        $curl_array = [];
        foreach(self::$handles as $i => $url)
        {
            $curl_array[$i] = curl_init($url);
            curl_setopt($curl_array[$i], CURLOPT_RETURNTRANSFER, true);
            curl_multi_add_handle($mh, $curl_array[$i]);
		}
		return $mh;
	}
   
    /**
     * @method prepare_curl_handle
     * @param curl_multi_handler
     * 
     * multicast engage
	 * 
     */
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

    /**
     * @method perform_curl_close
     * @param curl_multi_handler
	 * @param handles
     * 
	 * close curl inits
	 * 
     */
	public static function perform_curl_close($curl_multi_handler, $handles) {
	   
			  // is this necessary
		foreach($handles as $handle){
			curl_multi_remove_handle($curl_multi_handler, $handle);
		}
	
		curl_multi_close($curl_multi_handler);
	}
   
    /**
     * @method execute_multiple_curl_handles
	 * 
	 * execute multiple handles
	 * 
     */
	public static function execute_multiple_curl_handles() {
		$curl_multi_handler = self::create_multi_handler();
		self::add_handles($curl_multi_handler, self::$handles);
		self::perform_multi_exec($curl_multi_handler);
		self::perform_curl_close($curl_multi_handler, self::$handles);
	}
}