<?php

class Shodan {
	private $apiKey;
	
	/*
	 * Instantiating costants 
	 */
	const TYPE_BOOLEAN = 'BOOLEAN';
	const TYPE_INTEGER = 'INTEGER';
	const TYPE_STRING = 'STRING';
	
	const PARAMETER_OPTIONAL = 'OPTIONAL';
	const PARAMETER_MANDATORY = 'MANDATORY';
	
	const POSITION_GET = 'GET';
	const POSITION_QUERY = 'QUERY';
	const POSITION_POST = 'POST';
	
	const REST_API = 'API';
	const REST_EXPLOIT = 'EXPLOIT';
	const STREAM_API = 'STREAM_API';
	
	/*
	 * Shodan methods
	 */
	private $_api = array(
		'ShodanHost' => array(
			'rest' => self::REST_API,
			
			'ip' => array(
				'type' => self::TYPE_STRING,
				'optional' => self::PARAMETER_MANDATORY,
				'position' => self::POSITION_GET,
			),
			'history' => array(
				'type' => self::TYPE_BOOLEAN,
				'optional' => self::PARAMETER_OPTIONAL,
				'position' => self::POSITION_QUERY,
			),
			'minify' => array(
				'type' => self::TYPE_BOOLEAN,
				'optional' => self::PARAMETER_OPTIONAL,
				'position' => self::POSITION_QUERY,
			),
		),
		
		'ShodanHostCount' => array(
			'rest' => self::REST_API,
			
			'query' => array(
				'type' => self::TYPE_STRING,
				'optional' => self::PARAMETER_MANDATORY,
				'position' => self::POSITION_QUERY,
			),
			'facets' => array(
				'type' => self::TYPE_STRING,
				'optional' => self::PARAMETER_OPTIONAL,
				'position' => self::POSITION_QUERY,
			),
		),
		
		'ShodanHostSearch' => array(
			'rest' => self::REST_API,
			
			'query' => array(
				'type' => self::TYPE_STRING,
				'optional' => self::PARAMETER_MANDATORY,
				'position' => self::POSITION_QUERY,
			),
			'facets' => array(
				'type' => self::TYPE_STRING,
				'optional' => self::PARAMETER_OPTIONAL,
				'position' => self::POSITION_QUERY,
			),
		),
		
		'ShodanHostSearchTokens' => array(
			'rest' => self::REST_API,
			
			'query' => array(
				'type' => self::TYPE_STRING,
				'optional' => self::PARAMETER_MANDATORY,
				'position' => self::POSITION_QUERY,
			),
		),
		
		'ShodanPorts' => array(
			'rest' => self::REST_API,
		),
		
		'ShodanProtocols' => array(
			'rest' => self::REST_API,
		),
		
		'ShodanScan' => array(
			'rest' => self::REST_API,
			
			'ips' => array(
				'type' => self::TYPE_STRING,
				'optional' => self::PARAMETER_MANDATORY,
				'position' => self::POSITION_POST,
			),
		),
		
		'ShodanScanInternet' => array(
			'rest' => self::REST_API,
			
			'port' => array(
				'type' => self::TYPE_INTEGER,
				'optional' => self::PARAMETER_MANDATORY,
				'position' => self::POSITION_POST,
			),
			'protocol' => array(
				'type' => self::TYPE_STRING,
				'optional' => self::PARAMETER_MANDATORY,
				'position' => self::POSITION_POST,
			),
		),
		
		'ShodanScanId' => array(
			'rest' => self::REST_API,
			
			'id' => array(
				'type' => self::TYPE_STRING,
				'optional' => self::PARAMETER_MANDATORY,
				'position' => self::POSITION_GET,
			),
		),
		
		'ShodanServices' => array(
			'rest' => self::REST_API,
		),
		
		'ShodanQuery' => array(
			'rest' => self::REST_API,
			
			'page' => array(
				'type' => self::TYPE_INTEGER,
				'optional' => self::PARAMETER_OPTIONAL,
				'position' => self::POSITION_QUERY,
			),
			'sort' => array(
				'type' => self::TYPE_STRING,
				'optional' => self::PARAMETER_OPTIONAL,
				'position' => self::POSITION_QUERY,
			),
			'order' => array(
				'type' => self::TYPE_STRING,
				'optional' => self::PARAMETER_OPTIONAL,
				'position' => self::POSITION_QUERY,
			),
		),
		
		'ShodanQuerySearch' => array(
			'rest' => self::REST_API,
			
			'query' => array(
				'type' => self::TYPE_STRING,
				'optional' => self::PARAMETER_MANDATORY,
				'position' => self::POSITION_QUERY,
			),
			'page' => array(
				'type' => self::TYPE_INTEGER,
				'optional' => self::PARAMETER_OPTIONAL,
				'position' => self::POSITION_QUERY,
			),
		),
		
		'ShodanQueryTags' => array(
			'rest' => self::REST_API,
			
			'size' => array(
				'type' => self::TYPE_INTEGER,
				'optional' => self::PARAMETER_OPTIONAL,
				'position' => self::POSITION_QUERY,
			),
		),
		
		'LabsHoneyscore' => array(
			'rest' => self::REST_API,
			
			'ip' => array(
				'type' => self::TYPE_STRING,
				'optional' => self::PARAMETER_MANDATORY,
				'position' => self::POSITION_GET,
			),
		),
		
		'Search' => array(
			'rest' => self::REST_EXPLOIT,
			
			'query' => array(
				'type' => self::TYPE_STRING,
				'optional' => self::PARAMETER_MANDATORY,
				'position' => self::POSITION_QUERY,
			),
			'facets' => array(
				'type' => self::TYPE_STRING,
				'optional' => self::PARAMETER_OPTIONAL,
				'position' => self::POSITION_QUERY,
			),
			'page' => array(
				'type' => self::TYPE_INTEGER,
				'optional' => self::PARAMETER_OPTIONAL,
				'position' => self::POSITION_QUERY,
			),
		),
		
		'Count' => array(
			'rest' => self::REST_EXPLOIT,
			
			'query' => array(
				'type' => self::TYPE_STRING,
				'optional' => self::PARAMETER_MANDATORY,
				'position' => self::POSITION_QUERY,
			),
			'facets' => array(
				'type' => self::TYPE_STRING,
				'optional' => self::PARAMETER_OPTIONAL,
				'position' => self::POSITION_QUERY,
			),
		),
		
		'ShodanBanners' => array(
			'rest' => self::STREAM_API,
		),
		
		'ShodanAsn' => array(
			'rest' => self::STREAM_API,
			
			'asn' => array(
				'type' => self::TYPE_STRING,
				'optional' => self::PARAMETER_MANDATORY,
				'position' => self::POSITION_GET,
			),
		),
		
		'ShodanCountries' => array(
			'rest' => self::STREAM_API,
			
			'countries' => array(
				'type' => self::TYPE_STRING,
				'optional' => self::PARAMETER_MANDATORY,
				'position' => self::POSITION_GET,
			),
		),
		
		'ShodanPortsStream' => array(
			'rest' => self::STREAM_API,
			
			'ports' => array(
				'type' => self::TYPE_STRING,
				'optional' => self::PARAMETER_MANDATORY,
				'position' => self::POSITION_GET,
			),
		),
	);
	
	/**
	 * Construct.
	 * 
	 * @param string $apiKey;
	 * @return void;
	 */
	public function __construct($apiKey, $returnType = FALSE) {
		$this->apiUrl = 'https://api.shodan.io';
		$this->exploitUrl = 'https://exploits.shodan.io/api';
		$this->streamUrl = 'https://stream.shodan.io';
		$this->apiKey = $apiKey;
		
		// false = object; true = array
		define('RETURN_TYPE', $returnType);
	}
	
	private function _parseHeaders($headers) {
		$head = array();
		
		foreach ($headers as $k => $v) {
			$t = explode(':', $v, 2);
			
			if (isset($t[1])) {
				$head[trim($t[0])] = trim($t[1]);
			} else {
				$head[] = $v;
				if (preg_match( '|HTTP/[0-9\.]+\s+([0-9]+)|', $v, $out)) {
					$head['reponse_code'] = intval($out[1]);
				}
			}
		}
		
		return $head;
	}
	
	private function _request($url, $post = FALSE, $options = FALSE) {
		if (!$options) {
			$options = array(
				'http' => array(
					'method' => 'GET',
					'header' => 'Accept-language: en'."\n",
					'timeout' => 10,
					'ignore_errors' => TRUE,
				)
			);
		}
		
		if ($post) {
			$options['http']['header'] .= 'Content-type: application/x-www-form-urlencoded'."\n";
			$options['http']['method'] = 'POST';
			$options['http']['content'] = http_build_query($post);
		}
		
		$response = @file_get_contents(
			$url,
			FALSE,
			stream_context_create($options)
		);
		
		$responseDecoded = json_decode($response, RETURN_TYPE);
		
		$responseHeaders = $this->_parseHeaders($http_response_header);
		
		if (
			$responseHeaders['reponse_code'] != 200 ||
			isset($responseDecoded['error'])
		) {
			$error = $responseHeaders[0];
			
			if (isset($responseDecoded['error'])) {
				$error = $responseDecoded['error'];
			}
			
			throw new Exception('HTTP Error: '.$error);
		}
		
		return $responseDecoded;
	}
	
	private function _request_stream($url, $post = FALSE, $options = FALSE) {
		if (!$options) {
			$options = array(
				'http' => array(
					'method' => 'GET',
					'header' => 'Accept-language: en'."\n",
					'timeout' => 10,
					'ignore_errors' => TRUE,
				)
			);
		}
		
		if ($post) {
			$options['http']['header'] .= 'Content-type: application/x-www-form-urlencoded'."\n";
			$options['http']['method'] = 'POST';
			$options['http']['content'] = http_build_query($post);
		}
		
		$context = stream_context_create($options);
		
		$response = fopen($url, 'r', false, $context);
		fpassthru($response);
		fclose($response);
		
		$responseDecoded = json_decode($response, RETURN_TYPE);
		
		$responseHeaders = $this->_parseHeaders($http_response_header);
		
		if (
			$responseHeaders['reponse_code'] != 200 ||
			isset($responseDecoded['error'])
		) {
			$error = $responseHeaders[0];
			
			if (isset($responseDecoded['error'])) {
				$error = $responseDecoded['error'];
			}
			
			throw new Exception('HTTP Error: '.$error);
		}
		
		return $responseDecoded;
	}
	
	
	public function __call($method, $args) {
		if (!isset($this->_api[$method])) {
			throw new Exception('Unknown method: '.$method);
		}
		
		/* Generate the URL for the call */
		$preg = preg_replace('|([A-Z])|e', '"/".strtolower("$0")', $method);
		
		if ($this->_api[$method]['rest'] == self::REST_API) {
			$url = $this->apiUrl.$preg;
		} elseif ($this->_api[$method]['rest'] == self::REST_EXPLOIT) {
			$url = $this->exploitUrl.$preg;
		} else {
			$url = $this->streamUrl.$preg;
		}
		
		// Fix URL for duplicated methods
		if ($method == 'ShodanScanId') {
			$url = preg_replace('|/id|e', '', $url);
		} else if ($method == 'ShodanPortsStream') {
			$url = preg_replace('|/stream|e', '', $url);
		}
		
		$query = '?key='.$this->apiKey;
		$post = FALSE;
		
		if (count($args) > 0) {
			$args = $args[0];
			
			foreach ($this->_api[$method] as $parameter => $config) {
				// Skip 'rest'
				if (
					$parameter == 'rest'
				) {
					continue;
				}
				
				if (
					$config['optional'] == self::PARAMETER_MANDATORY &&
					!isset($args[$parameter])
				) {
					throw new Exception('Parameter is mandatory: '.$parameter);
				}
				
				if (isset($args[$parameter])) {
					if ($config['position'] == self::POSITION_GET) {
						$url .= '/'.urlencode($args[$parameter]);
						
					} elseif ($config['position'] == self::POSITION_POST) {
						$post[urlencode($parameter)] = $args[$parameter];
					} else {
						$query .= '&'.urlencode($parameter).'='.urlencode($args[$parameter]);
					}
				}
			}
		}
		
		// Call the proper request method
		if ($this->_api[$method]['rest'] == self::STREAM_API) {
			return $this->_request_stream($url.$query, $post);
		}
		
		return $this->_request($url.$query, $post);
		
	}
	
	public function getApis() {
		return $this->_api;
	}
}
