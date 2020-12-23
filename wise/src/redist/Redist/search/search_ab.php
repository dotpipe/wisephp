<?php

namespace wise\src\redist\Redist\search;

interface search_ab {

	// look for user first in, amongst the
	// files that are in self::path_user (krsort[0])
	public static function find_user_first($token);
	// look for user last in, amongst the
	// files that are in self::path_user (ksort[0])
	public static function find_user_last($token);
	// look for users amongst the
	// files that are in self::path_user (krsort)
	public static function find_user_range($token);
	// return all user requests without sorting
    public static function find_user_queue($token);
    

}