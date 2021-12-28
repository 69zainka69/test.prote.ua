<?php
class Response {
	private $headers = array();
	private $level = 0;
	private $output;

	public function addHeader($header) {
		$this->headers[] = $header;
	}
	/*public function getHeader() {
		return $this->headers;
	}*/

	public function redirect($url, $status = 302) {
		header('Location: ' . str_replace(array('&amp;', "\n", "\r"), array('&', '', ''), $url), true, $status);
		exit();
	}

	public function setCompression($level) {
		$this->level = $level;
	}

	public function setOutput($output) {
		$this->output = $output;
	}
	public function setOutputs($output) {
		$this->outputs = $output;
	}
	public function getOutput() {
		return $this->output;
	}

	/*public function webpRebuild($output) {
		if (isset($_SERVER['HTTP_ACCEPT']) && isset($_SERVER['HTTP_USER_AGENT'])) {
			if( strpos( $_SERVER['HTTP_ACCEPT'], 'image/webp' ) !== false ) {	
				$re = '/(cache)(.*)(\.jpg|\.png|.jpeg)/U';
				$subst = '$1webp$2.webp';
				$this->output = preg_replace($re, $subst, $this->output);
			}
		}
	}*/

	public function webpRebuild($output) {
				$gd = gd_info();
				if ($gd['WebP Support']) {
					$uri = '';

					if (isset($_SERVER['REQUEST_URI'])) {
						$uri = $_SERVER['REQUEST_URI'];
					}
					
					if (stripos($uri, 'admin') === false) {
						if (isset($_SERVER['HTTP_ACCEPT']) && isset($_SERVER['HTTP_USER_AGENT'])) {
							if( strpos( $_SERVER['HTTP_ACCEPT'], 'image/webp' ) !== false ) {	
								$re = '/(cache)(.*)(\.jpg|\.png|.jpeg)/U';
								$subst = '$1webp$2.webp';
								$this->output = preg_replace($re, $subst, $this->output);
							}
						}
					}
				}
			}

	private function compress($data, $level = 0) {
		if (isset($_SERVER['HTTP_ACCEPT_ENCODING']) && (strpos($_SERVER['HTTP_ACCEPT_ENCODING'], 'gzip') !== false)) {
			$encoding = 'gzip';
		}

		if (isset($_SERVER['HTTP_ACCEPT_ENCODING']) && (strpos($_SERVER['HTTP_ACCEPT_ENCODING'], 'x-gzip') !== false)) {
			$encoding = 'x-gzip';
		}

		if (!isset($encoding) || ($level < -1 || $level > 9)) {
			return $data;
		}

		if (!extension_loaded('zlib') || ini_get('zlib.output_compression')) {
			return $data;
		}

		if (headers_sent()) {
			return $data;
		}

		if (connection_status()) {
			return $data;
		}

		$this->addHeader('Content-Encoding: ' . $encoding);

		return gzencode($data, (int)$level);
	}
	public function outputs() {

		if ($this->output) {

		
				$this->webpRebuild($this->output);
				$output = $this->minify($this->output);
			
				header("Cache-Control:no-store, no-cache");
			if (!headers_sent()) {
				foreach ($this->headers as $header) {
					header("Cache-Control:no-store, no-cache");
					header($header, true);
				}
			}

			echo $output;
		}
	}
	public function output() {

		if ($this->output) {

			/*if(file_exists('seoshield-clientt/main.php')){
		        include_once('seoshield-clientt/main.php');
		        if(function_exists('seo_shield_start_cms'))
		            seo_shield_start_cms();
		        if(function_exists('seo_shield_out_buffer'))
		            $this->output = seo_shield_out_buffer($this->output);
		    }*/
		    
			/*if ($this->level) {
				//$output = $this->minify($this->output);
				$output = $this->compress($this->output, $this->level);
			} else {*/
				//$output = $this->output;
				$this->webpRebuild($this->output);
				$output = $this->minify($this->output);
			//}

			if (!headers_sent()) {
				foreach ($this->headers as $header) {
					header($header, true);
				}
			}

			echo $output;
		}
	}

	function minify($html) {
		//return $html;
		//$html = str_replace("&nbsp;", "", $html);
		//$replace = array("  ","\t","\n");
		//$search = array("\t","\n","\r\n");
		//$replace = array('','','');
		//$html = str_replace($search, "", $html);
		//$html = preg_replace("`>\s+<`", "> <", $html);
		//$html=preg_replace('/\s*\t*/','',$html);
		//vdump($this->headers);
		if(!in_array('Content-Type: application/json', $this->headers)){

		
		//$html = str_replace('<style>', '<svg style="height:0;width:0;"><style>', $html);
		//$html = str_replace('</style>', '</style></svg>', $html);
		}

		$replace = array(
			/*'&nbsp;' => '&#160;',
			'&copy;' => '&#169;',
			'&acirc;' => '&#226;',
			'&cent;' => '&#162;',
			'&raquo;' => '&#187;',
			'&laquo;' => '&#171;'*/
		);

		/*$search = array(
	        '/\>[^\S ]+/s',  // strip whitespaces after tags, except space
	        '/[^\S ]+\</s',  // strip whitespaces before tags, except space
	        '/(\s)+/s'       // shorten multiple whitespace sequences
	    );
	    $replace = array(
	        '>',
	        '<',
	        '\\1'
	    );
	    $html = preg_replace($search, $replace, $html);*/
	    //return $buffer;
		return $html;
	}	
	function minify_html($html) {

		$search = array(
	        '/\>[^\S ]+/s',
	        '/[^\S ]+\</s',
	        '/(\s)+/s'
	    );
	    $replace = array(
	        '>',
	        '<',
	        '\\1'
	    );
	    $html = preg_replace($search, $replace, $html);
	    
		return $html;
	}
}