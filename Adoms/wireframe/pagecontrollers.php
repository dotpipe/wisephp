<?php

spl_autoload_register(function ($className)
{
	$path1 = '/src/lib/';
	$path2 = './';

	if (file_exists($path1.$className.'.php'))
		include $path1.$className.'.php';
	else
		include $path2.$className.'.php';
});


	class PageControllers {

		public $token;
		public $view;
		public $mvc = array();
		public $md;
		public $sid = array();
		/*
		*
		* public function __construct
		* @parameters string, string
		*
		*/
		function __construct(string $tok, string $view = 'index') {
			$this->mvc = null;
			$this->token = $tok;
			if (!is_dir("$this->token"))
				mkdir("$this->token");
			if (!is_dir("$this->token")) {
				echo "Unable to create directories needed";
			}
			if (!is_dir("$this->token/view/"))
				mkdir("$this->token/view");
			if (!is_dir("$this->token/view")) {
				echo "Unable to create directories needed";
			}
			if (!is_dir($this->token."/view/".$_COOKIE['PHPSESSID']))
				mkdir($this->token."/view/".$_COOKIE['PHPSESSID']);
			if (!is_dir($this->token."/view/".$_COOKIE['PHPSESSID'])) {
				echo "You do not have Cookies Enabled";
				exit();
			}
			if (!is_dir("$this->token/view/shared"))
				mkdir("$this->token/view/shared");
			if (!is_dir("$this->token/view/shared")) {
				echo "Unable to create directories needed";
			}
			if (!file_exists("$this->token/config.json"))
				touch("$this->token/config.json");
			if (!file_exists("$this->token/index.php"))
				touch("$this->token/index.php");
			if (!file_exists("$this->token/view/shared/index.php"))
				touch("$this->token/view/shared/index.php");
			if (!file_exists("$this->token/config.json")) {
				echo "Unable to create files needed";
			}
			if (!file_exists("$this->token/index.php")) {
				echo "Unable to create files needed";
			}
			if (!file_exists("$this->token/view/shared/index.php")) {
				echo "Unable to create files needed1";
			}
			$this->path = "$this->token/view";
			$this->view = $view;
			$this->mvc[$tok] = new PageModels($view);
			$this->mvc[$tok]->view = new PageViews($tok, $view);
			$this->mvc[$tok]->md = $_COOKIE['PHPSESSID'];
			setcookie('PHPSESSID', $_COOKIE['PHPSESSID'], time() * 60 * 60 * 24 * 365, "$this->token/$this->md");
			$this->mvc[$tok]->sid['model'] = new PageModels($_COOKIE['PHPSESSID']);
			$this->mvc[$tok]->sid['view'] = new PageViews($tok, $_COOKIE['PHPSESSID']);
		}

		/*
		*
		* public function addModelData
		* @parameters string, array
		*
		*/
		public function addModelData(string $view_name, array $data) {
			$this->mvc[$view_name]->addModelData($view_name, $data);
			return 1;
		}

		/*
		*
		* public function save
		* @parameters none
		*
		*/
		public function save() {
			$fp = fopen("$this->token/$this->md/config.json", "w");
			fwrite($fp, serialize($this));
			fclose($fp);
			return 1;
		}
		
		
		/*
		*
		* public function paginateModels
		* @parameters string, string, int, int
		*
		*/
		public function paginateModels(string $view_name, string $filename, int $begin = 0, int $end = 0) {
			$x = $this->mvc[$this->token]->paginateModels($this->token, $view_name, $filename, $begin, $end);
			return $x;
		   
		}
		
		/*
		*
		* private function add_view
		* @parameters string
		*
		*/
		private function add_view(string $view_name) {
			if (is_dir("/$this->path/$view_name/")) {
				if (!file_exists("/$this->path/$view_name/index.php")) {
					$fp = fopen("/$this->path/$view_name/index.php", "w");
					fclose($fp);
				}
				
			}
			else {
				mkdir("/$this->path/$view_name");
				if (!is_dir("/$this->path/$view_name")) {
					echo "Permissions Error: Unable to create Directory";
					return 0;
				}
				
				touch("/$this->path/$view_name/index.php");
				touch("$this->token/config.json");
			}
			$this->mvc[$view_name] = new PageModels($view_name);
			$this->mvc[$view_name]->view = new PageViews($this->token, $view_name);
			return 1;
		}
		
		/*
		*
		* public function newView
		* @parameters string
		*
		*/
		public function newView(string $view_name) {
			$this->add_view($view_name);
		}
		
		/*
		*
		* public function loadJSON
		* @parameters none
		*
		*/
		public function loadJSON() {
			if (file_exists("$this->token/config.json") && filesize("$this->token/config.json") > 0)
				$fp = fopen("$this->token/config.json", "r");
			else
				return 0;
			$json_context = fread($fp, filesize("$this->token/config.json"));
			$old = unserialize($json_context);
			$b = $old->mvc[$old->token];
			foreach ($b as $key => $val) {
				$old->mvc[$this->token]->$key = $b->$key;
			}
			return $old;
		}
		
		/*
		*
		* public function addPartial
		* @parameters string
		*
		*/
		public function addPartial(string $filename) {
			return $this->view->addPartial($filename);
		}
		
		/*
		*
		* public function addShared
		* @parameters string
		*
		*/
		public function addShared(string $filename) {
			return $this->view->addShared($filename);
		}
		
		/*
		*
		* public function addAction
		* @parameters string, string, string
		*
		*/
		public function addAction(string $token, string $view_name, string $action_name) {
			return $this->actions[] = new PageActions($this->token, $view_name, $action_name);
		}
	}
