<?php

	namespace Adoms;
	if (!isset($_SESSION))
		session_start();

	include_once ("load.php");
	use Adoms\oauth2\userController;
	use Adoms\pasm\PASM;

	class Routes extends oauth2\UserController {

		public $QURY;
		public $resh;
		public $reqh;
		public $pasm;
		public $uri;

		/*
		*
		* public function __construct
		* @parameters none
		*
		*/
		function __construct() {
			$this->pasm = new PASM();
			$GET = isset($_SERVER['REQUEST_METHOD']) ? $_SERVER['REQUEST_METHOD'] : null;
			$this->QURY = null;
			if ($GET != null) {
				if ($GET === 'GET')
					$this->QURY = $_GET;
				else if ($GET === 'POST')
					$this->QURY = $_POST;
				if (!isset($this->QURY) || $this->QURY['port'] == null)
					$this->QURY['port'] = 80;
				if (!isset($this->QURY) || $this->QURY['user'] == null)
					$this->QURY['user'] = "guest";
			}
			$this->reqHeaders();
			$this->resHeaders();

		}
		
		/*
		*
		* public function addContract
		* @parameters recv, from, target, port, user
		*
		*/
		public function addContract() {
			if ($this->group_id > 0)
				return false;
			if (count($this->pasm->stack) == 0 && file_exists($_COOKIE['PHPSESSID']))
				$this->load($_COOKIE['PHPSESSID']);
			
			$sp = $this->getContract();
			
			if ($sp != -1) {
				$p = array_search($sp, $this->pasm->stack);
				$sp['allowed'] = 1;
				$this->pasm->stack[$p] = $sp;
			}
			else {

				$this->pasm->addr([
					"recv" => $this->QURY['recv'], 
					"from" => $this->QURY['from'], 
					"allowed" => 1, 
					"redirect" => [basename($_SERVER['PHP_SELF']), $this->QURY['target']], 
					"port" => $this->QURY['port'], 
					"user" => $this->QURY['user']
					])
					->movr()
					->end();
			}
			
			return $this;
		}
		
		/*
		*
		* public function addContract
		* @parameters recv, from, target, port, user
		*
		*/
		public function addUserToContract() {
			if ($this->group_id > 0)
				return false;
			if (count($this->pasm->stack) == 0 && file_exists($_COOKIE['PHPSESSID']))
				$this->load($_COOKIE['PHPSESSID']);
			
			$sp = $this->getContract();
			
			if ($sp != -1) {
				$p = array_search($sp, $this->pasm->stack);
				$sp['allowed'] = 1;
				$this->pasm->stack[$p] = $sp;
			}
			else {

				$this->pasm->addr([
					"from" => $this->QURY['from'],
					"allowed" => 1,
					"redirect" => [basename($_SERVER['PHP_SELF']), $this->QURY['recv'] . '/' . $this->QURY['user'] . '/' . $this->QURY['sub'] . '/' . $this->QURY['target']], 
					"port" => $this->QURY['port'],
					"user" => $this->QURY['user']
					])
					->movr()
					->end();
			}
			
			return $this;
		}
		
		/*
		*
		* public function remContract
		* @parameters none
		*
		*/
		public function remContract() {
			if ($this->group_id > 0)
				return false;
			
			$sp = $this->getContract();
			if ($sp != -1) {
				$p = array_search($sp, $this->pasm->stack);
				$sp['allowed'] = 0;
				$this->pasm->stack[$p] = $sp;
			}
			else {
				$this->pasm->addr([
					"recv" => $this->QURY['recv'], 
					"from" => $this->QURY['from'], 
					"allowed" => 1, 
					"redirect" => [basename($_SERVER['PHP_SELF']), $this->QURY['target']], 
					"port" => $this->QURY['port'], 
					"user" => $this->QURY['user']
					])
					->movr()
					->end();
			}
			return $this;
		}
		
		/*
		*
		* public function remContract
		* @parameters none
		*
		*/
		public function remUserFromContract() {
			if ($this->group_id > 0)
				return false;
			
			$sp = $this->getContract();
			if ($sp != -1) {
				$p = array_search($sp, $this->pasm->stack);
				$sp['allowed'] = 0;
				$this->pasm->stack[$p] = $sp;
			}
			else {
				$this->pasm->addr([
					"from" => $this->QURY['from'],
					"allowed" => 1,
					"redirect" => [basename($_SERVER['PHP_SELF']), $this->QURY['recv'] . '/' . $this->QURY['user'] . '/' . $this->QURY['sub'] . '/' . $this->QURY['target']], 
					"port" => $this->QURY['port'],
					"user" => $this->QURY['user']
					])
					->movr()
					->end();
			}
			return $this;
		}
		
		/*
		*
		* public function getContract
		* @parameters none
		*
		*/
		public function getContract() {
			$user = [
				"from" => $this->QURY['from'],
				"allowed" => 1,
				"redirect" => [basename($_SERVER['PHP_SELF']), $this->QURY['recv'] . '/' . $this->QURY['user'] . '/' . $this->QURY['sub'] . '/' . $this->QURY['target']], 
				"port" => $this->QURY['port'],
				"user" => $this->QURY['user']
			];
			$redirect = [
				"recv" => $this->QURY['recv'], 
				"from" => $this->QURY['from'], 
				"allowed" => 1, 
				"redirect" => [basename($_SERVER['PHP_SELF']), $this->QURY['target']], 
				"port" => $this->QURY['port'], 
				"user" => $this->QURY['user']
				
			];
			foreach ($this->pasm->stack as $key) {
				if (($redirect) == ($key) || ($user) == ($key))
				{
					return $redirect == $key ? $redirect : $user;
				}
				$redirect['allowed'] = 0;
				$user['allowed'] = 0;
				if (($redirect) == ($key) || ($user) == ($key))
				{
					return $redirect == $key ? $redirect : $user;
				}
				$redirect['allowed'] = 1;
				$user['allowed'] = 1;
			}
			return -1;
		}
		
		/*
		*
		* public function getContract
		* @parameters string
		*
		*/
		public function http_parse_query(string $query) {
			$parameters = array();
			$query = explode('?', $query);
			$queryParts = explode('&', $query[1]);
			foreach ($queryParts as $queryPart) {
				$keyValue = explode('=', $queryPart, 2);
				if (substr($keyValue,strlen($keyValue)-3) != "[]")
					$parameters[$keyValue[0]] = $keyValue[1];
				else {
					$keyValue = substr($keyValue,strlen($keyValue)-3);
					$parameters[$keyValue][] = $keyValue[1];
				}
			}
			return $parameters;
		}
		
		public function route(){
			$config = json_decode(file_get_contents("config.json"));
			if (($sp = $this->getContract()) != -1)
			{
				if ($sp['allowed'] == 0) {
					header("Location: error404.php");
					
				}
				$field = []; 
				$protocol = getservbyport($sp['port'],'tcp');
				$aim = $sp['redirect'][1];
				$config = json_decode(file_get_contents("config.json"));
				# Create a connection
				$url = "{$protocol}://{$config->domain}/{$aim}";
				if ($_SERVER['REQUEST_METHOD'] == "POST") {
					$handle = curl_init(); 
					$this->reqHeaders();  
					$user_agent=$_SERVER['HTTP_USER_AGENT'];
					curl_setopt($handle, CURLOPT_HTTPHEADER, $this->reqh);
					//curl_setopt($handle, CURLOPT_HEADER, true);
					//curl_setopt($handle, CURLOPT_TIMEOUT, 20);
					curl_setopt($handle, CURLOPT_URL, $url);
					curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
					curl_setopt($handle, CURLOPT_POST, true);
					curl_setopt($handle, CURLOPT_FOLLOWLOCATION,true);
					curl_setopt($handle, CURLOPT_POSTFIELDS, http_build_query($this->QURY));
					curl_setopt($handle, CURLOPT_BINARYTRANSFER, true);
					//curl_setopt($handle, CURLOPT_ENCODING, "");
					//curl_setopt($handle, CURLOPT_USERAGENT, $user_agent);
					$page_contents = curl_exec($handle);
					echo $page_contents;
				}
				else {
					$data = "";
					foreach ($this->QURY as $key => $value) {
						$data .= "&{$key}={$value}";
					}
					$data = substr($data,1);
					header("Location: {$aim}?{$data}");
				}
			}
			else {
				$this->reqHeaders();
				$q = basename($_SERVER['PHP_SELF']);
				header("Location: error.php");
			}
		}
	
		/*
		*
		* public function reqHeaders
		* @parameters none
		*
		*/
		public function reqHeaders() {
			$this->reqh = apache_request_headers();
			return $this;
		}

		/*
		*
		* public function resHeaders
		* @parameters none
		*
		*/
		public function resHeaders() {
			$this->resh = apache_response_headers();
			return $this;
		}

		/*
		*
		* public function save
		* @parameters string
		*
		*/
		public function save(string $filename = "") {
			
			if ($filename == "")
				$filename = $_COOKIE['PHPSESSID'];
			if (count($this->pasm->stack) == 0 && file_exists($_COOKIE['PHPSESSID']))
				$this->pasm->recvr_stack($filename);

			//$this->pasm->stack;
			//$this->pasm->stack = $vartemp;
			$this->pasm->load_str($filename)
				->save_stack_file()
				->end();
			return $this;
		}
		
		/*
		*
		* public function load
		* @parameters string
		*
		*/
		public function load(string $filename= "") {
			$this->pasm->stack = [];
			if ($filename == "")
				$filename = $_COOKIE['PHPSESSID'];
			if (!file_exists($filename))
				return false;
			$this->pasm->recvr_stack($filename)
				->end();
			return $this;
		}

	}
?>
