<?php

namespace wise\src\redist\Redist\search;

use wise\src\redist\Redist\search_methods;

require "../../../../vendor/autoload.php";

class search extends search_methods implements search_ab {
    
	public static function find_user_first($token) {
        return parent::find_user_first($token);
    }
    
	public static function find_user_last($token) {
        return parent::find_user_last($token);
    }

	public static function find_user_range($token) {
        return parent::find_user_range($token);
    }

	public static function find_user_queue($token) {
        return parent::find_user_queue($token);
    }
}