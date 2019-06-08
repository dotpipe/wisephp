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


	class PageModels {
	
		public $model = array();
		public $valid = array();
		public $errormsgs = array();
		public $data = array();
		public $copy;
		public $token;
		public $label;
		
		/*
		*
		* public function __construct
		* @parameters string, string
		*
		*/
		function ___construct(string $token, string $view_name) {
			$this->valid = [];
			$this->model = [];
			$this->errormsgs = [];
			$this->token = $token;
			$this->copy = $view_name;
		}

		/*
		*
		* public function addModelField
		* @parameters string
		*
		*/
		public function addModelField(string $fieldname, string $regex = "/.*/", string $errmsg = "Please reenter data", string $lbl = null) {
			if ($fieldname == null)
				return 0;
			$this->model['data'] = null;
			$this->model['data']['label'] = $lbl;
			$this->model['data']['regex'] = $regex;
			$this->model['data']['errmsg'] = $errmsg;
			return 1;
		}
		
		
		/*
		*
		* public function editModelData
		* @parameters string, array
		*
		*/
		public function editModelData(string $view_name, array $data) {
			$wrong_ans = [];
			$this->checkValid($this->valid, $data, $wrong_ans);
			foreach ($data as $k=>$v) {
				if ($wrong_ans[$k] == null)
					$this->data[$view_name]->$k = null;
				else
					$this->data[$view_name]->$k = $v;
			}
			return 1;
		}

		/*
		*
		* public function addModelData
		* @parameters string, array
		*
		*/
		public function addModelData(string $view_name, array $data) {
			$wrong_ans = [];
			$this->checkValid($this->valid, $data, $wrong_ans);
			foreach ($data as $k=>$v) {
				if ($wrong_ans[$k] == null)
					$this->data[$view_name][$k] = null;
				else
					$this->data[$view_name][$k] = $v;
			}
			return 1;
		}
		
		/*
		*
		* public function paginateModels
		* @parameters string, string, string, int, int
		*
		*/
		public function paginateModels(string $token, string $view_name, string $filename, int $begin = 0, int $end = 0) {
			$int_cnt = 0;
			$buf = "<?php\r\n\techo '<table>\r\n";
			$buf .= "\t\t<tr>\r\n";
			if ($begin == 0)
				$buf .= "\t\t\t<th style=\"background:opacity:0.0;border:0px;\"></th>\r\n";
			foreach ($this->model as $kn=>$vn) {
				if ($begin == $int_cnt || $end == 0 || $int_cnt < $end) {
					$buf .= "\t\t\t<th>$kn</th>\r\n";
				}
				$int_cnt++;
			}
			$int_cnt = 0;
			$buf .= "\t\t</tr>\r\n";
			$int_dat = 0;
			foreach ($this->data as $v1=>$va) {
				$buf .= "\t\t<tr>\r\n";
				if ($begin == 0 && $v1 == "label")
					$buf .= "\t\t\t<td>$v1</td>\r\n";
				foreach ($va as $k2=>$v2) {
					if (($begin >= $int_cnt && $int_cnt < $end) || $end == 0) {
						$buf .= "\t\t\t<td>$v2</td>\r\n";
					}
					$int_cnt++;
				}
				$int_cnt = 0;
				$int_dat++;
				$buf .= "\t\t</tr>\r\n";
			}
			$buf .= "\t</table>';\r\n?>\r\n";
			$view = "$token/view/$this->md/$filename";
			if (!file_exists($view))
				touch($view);
			if (!file_exists($view)) {
				echo "Unable to make files needed";
				return 0;
			}
			$fp = fopen($view, "w");
			fwrite($fp, $buf);
			fclose($fp);
			return $buf;
		}
		
		/*
		*
		* public function addModelValid
		* @parameters string, string, string
		*
		*/
		public function addModelValid(string $property, string $regex = "/.*/", string $errmsg = "Please check your entry", string $lbl = null) {
			$this->valid[$property]['label'] = $lbl;
			$this->valid[$property]['regex'] = $regex;
			$this->valid[$property]['errmsg'] = $errmsg;
			return 1;
		}
		
		/*
		*
		* public function errorReturn
		* @parameters string, array &
		*
		*/
		private function errorReturn(string $key, array &$errormsgs = array()) {
			$errormsgs[$key] = $this->valid[$key]['errmsg'];
			return 1;
		}

		/*
		*
		* public function checkValid
		* @parameters array, array, array &
		*
		*/
		public function checkValid(array $valid, array $data, array &$wrong_ans = array()) {
			$this->errormsgs = [];
			foreach ($data as $k => $v) {
				if ($k != "label" && isset($valid[$k]['regex']) && $v != null && !preg_match($valid[$k]['regex'], $v)) {
					$wrong_ans[$k] = null;
					$this->errorReturn($k, $this->errormsgs);
				}
				else
					$wrong_ans[$k] = $v;
			}
			return 1;
		}
	}