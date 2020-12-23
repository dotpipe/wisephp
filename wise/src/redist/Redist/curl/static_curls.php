<?php

namespace wise\src\redist\Redist\curl;

include 'pcurls.php';
include 'curl.php';

class static_curls extends curl implements pCurls {

	public static function execute_multiple_curl_handles() {
        return parent::execute_multiple_curl_handles();
    }
    
	public static function perform_curl_close($curl_multi_handler, $handles) {
        return parent::perform_curl_close($curl_multi_handler, $handles);
    }

	public static function perform_multi_exec($curl_multi_handler) {
        return parent::perform_multi_exec($curl_multi_handler);
    }

	public static function add_handles() {
        return parent::add_handles();
    }
	// This is where we translate our user files into the curl call
	public static function prepare_curl_handle($server_url, $fields, $token) {
        return parent::prepare_curl_handle($server_url, $fields, $token);
    }
	public static function prepare_curl_handles($server, $fields, $token) {
        return parent::prepare_curl_handles($server, $fields, $token);
    }
    public static function run() {
        return parent::run();
    }
    
	// For curl operations
	public static function set_content_type($type) {
		return parent::set_content_type($type);
    }
    
	public static function create_multi_handler() {
		return parent::create_multi_handler();
	}
}