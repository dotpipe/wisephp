<?php
namespace Adoms\src\lib;
spl_autoload_register(function ($className)
{
	$path1 = '/Adoms/src/lib/';
	$path2 = '';

	if (file_exists($path1.$className.'.php'))
		include $path1.$className.'.php';
	else
		include $path2.$className.'.php';
});

// REQUIRED FILE
/*
 * SCHOOL - Copyright (C) 2018
 * Author: Anthony Pulse, Jr.
 * @thexiv via twitter.com
 * inland14@live.com - www.github.com/thexiv
 * You may use this file. You may not
 * extract portions. You must
 * leave notices and comments
 * where they are. The code is
 * provided without liability. If you have
 * a bug, please explain your bug.
 * If you have an idea, leave a msg.
 * I have 2 contacts. you can reach
 * me at, above. Thank you.
 * Plz donate via PayPal!
 * You likey, Me likey! - Cabaret
*/

/* Swatch Containers Hypertext Object-Oriented Library for PHP
 * -------------------------------------------------------------
 * SCHOOL is a container super-extension for PHP 7+
 * that makes everything you thought difficult,
 * impossible, or completely outside the grasp of
 * PHPs language restrictions completely doable.
 * It contains each container Java has (except the
 * legacy ones) to make projects as suitable to other
 * coders to continue on when the work as they
 * have done ends, setting up a dialog between
 * incoming and outgoing programmers. This is all
 * made in the hopes that PHP will one day be
 * able to be used for GUI engagement; in other
 * words: OS based apps can be made strictly
 * from PHP and JS for Android and Windows!
 * -- Sincerely, @thexiv - inland14@live.com --
 * Donations Welcome!
*/


	class Error_call {
		public function __construct($message) {
			echo $err_type . ': ' . $err_msg . ' In file ' . $err_file . ' On line ' . $err_line;
		//	trigger_error($this->getCode(), $message, $this->getFile(), $this->getLine());
		}

		function error_msg($err_type, $err_msg, $err_file, $err_line) {
			echo $err_type . ': ' . $err_msg . ' In file ' . $err_file . ' On line ' . $err_line;
		}

	}


	class IndexException extends Error_call {
		public function __construct($message) {
			echo $this->getCode() . ': ' . $message . ' In file ' . $this->getFile() . ' On line ' . $this->getLine();
		//	trigger_error($this->getCode(), $message, $this->getFile(), $this->getLine());
		}
	}

	class Type_Error extends Error_call {
		public function __construct($message) {
			echo $this->getCode() . ': ' . $message . ' In file ' . $this->getFile() . ' On line ' . $this->getLine();

		//	trigger_error($this->getCode(), $message, $this->getFile(), $this->getLine());
		}
	}
 
	class SyntaxError extends Error {
		public function __construct($message)  {
			echo $this->getCode() . ': ' . $message . ' In file ' . $this->getFile() . ' On line ' . $this->getLine();

		//	trigger_error($this->getCode(), $message, $this->getFile(), $this->getLine());
		}
	}

	class Container {
		// Type Specifications
		public $typeOf;
		public $rootType;
		// $this->strict >= 1 to Use IndexExceptions
		// in Containers (use_strict($bool))
		public $strict;

		public function __construct() {
			$this->strict = FALSE;
		}

		// Strict IndexException Error Calling
		public function use_strict(bool $bool = FALSE) {
			if ($bool != 0)
				$this->strict = 1;
			else $this->strict = 0;
			return $this->strict;
		}
	}

	class Version {
		public function about($vbool)  {
			if ($vbool == 0) {
				echo 'Warim - Version 1.0<br>';
				echo 'Warim Object Oriented Library / PVC Model-View-Controller / Pipes Routing';
			}
			else if ($vbool == 1)
				echo 'Warim v1.0';
			else
				for ($i = 0 ; $i < $vbool ; $i++)
					echo 'Was \$vbool too complex an idea for you? ... ';
		}
	}