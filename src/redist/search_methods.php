<?php

require_once(__DIR__."/../../../../../vendor/autoload.php");
//require_once(__DIR__."/../../redist.php");
class search_methods extends Redist implements search_ab {

    /**
     * @method find_user_first
	 * @param token
     * 
	 * look for first email address amongst the
	 * files that are in self::path_user
	 * 
     */
	public static function find_user_first($token) {
		$search = [];
		$search = parent::detail_scrape();
		krsort($search);
		if ($search[0] != null)
			return $search[0];
		return false;
	}

    /**
     * @method find_user_last
	 * @param token
     * 
	 * look for last email address amongst the
	 * files that are in self::path_user
	 * 
     */
	public static function find_user_last($token) {
		$search = [];
		$search = parent::detail_scrape();
		ksort($search);
		if ($search[0] != null)
			return $search[0];
		return false;
	}

	
    /**
     * @method find_user_range
	 * @param token
     * 
	 * return users
	 * 
     */
	public static function find_user_range($token) {
		$search = [];
		$search = parent::detail_scrape();
		krsort($search);
		if ($search != null)
			return $search;
		return false;
	}

    /**
     * @method find_user_queue
	 * @param token
     * 
	 * look for an email address amongst files that are in "users.conf"
	 * 
     */
	public static function find_user_queue($token) {
		$search = [];
		$y = sizeof(parent::$request);
		$search = parent::detail_scrape();
		if ($search != null)
			return $search;
		return false;
	}

}