<?php

/**
 * \class Shodan
 * \brief Shodan class
 * 
 * This is the API class: costants, shodan methods and the generation of the HTTP requests are defined here. 
 */
class Shodan {
	private $apiKey;
	
	/**
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
	
	/**
	 * Shodan methods.
	 * @var array $_api;
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
		
		'ShodanScan_Id' => array(
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
		
		'ShodanPorts_Stream' => array(
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
	 * \fn __construct($apiKey, $returnType = FALSE)
	 * 
	 * @param string $apiKey;
	 * @param bool $returnType;
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
	
	/**
	 * Parse Headers.
	 * \fn _parseHeaders($headers)
	 * 
	 * @param string $headers;
	 * @return string $head;
	 */
	private function _parseHeaders($headers) {
		$head = array();
		
		foreach ($headers as $k => $v) {
			$t = explode(':', $v, 2);
			
			if (isset($t[1])) {
				$head[trim($t[0])] = trim($t[1]);
			} else {
				$head[] = $v;
				if (preg_match('|HTTP/[0-9\.]+\s+([0-9]+)|', $v, $out)) {
					$head['reponse_code'] = intval($out[1]);
				}
			}
		}
		
		return $head;
	}
	
	/**
	 * Request Context.
	 * \fn _requestContext($post = FALSE, $options = FALSE)
	 * 
	 * @param bool $post;
	 * @param bool $options;
	 * @return object $options;
	 */
	private function _requestContext($post = FALSE, $options = FALSE) {
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
		
		return stream_context_create($options);
	}
	
	/**
	 * Response Success HTTP.
	 * \fn _responseSuccessHTTP($headers)
	 * 
	 * @param string $headers;
	 * @return TRUE;
	 */
	private function _responseSuccessHTTP($headers) {
		$responseHeaders = $this->_parseHeaders($headers);
		
		if ($responseHeaders['reponse_code'] != 200) {
			return $responseHeaders[0];
		}
		
		return TRUE;
	}
	
	/**
	 * Response Success API.
	 * \fn _responseSuccessAPI($responseDecoded)
	 * 
	 * @param string $responseDecoded;
	 * @return TRUE;
	 */
	private function _responseSuccessAPI($responseDecoded) {
		if (isset($responseDecoded['error'])) {
			return $responseDecoded['error'];
		}
		
		return TRUE;
	}
	
	/**
	 * Response Success.
	 * \fn _responseSuccess($headers, $response)
	 * 
	 * @param string $headers;
	 * @param string $response;
	 * @return string $responseDecoded;
	 */
	private function _responseSuccess($headers, $response) {
		// Check for HTTP errors
		if (($errorHTTP = $this->_responseSuccessHTTP($headers)) !== TRUE) {
			// Decode
			$responseDecoded = $this->_responseDecode($response);
			
			// Check for API errors
			if (($errorAPI = $this->_responseSuccessAPI($responseDecoded)) !== TRUE) {
				throw new Exception('API Error: '.$errorAPI);
			}
			
			// If we were unable to identify the error in the response body, then
			// just raise the HTTP error
			throw new Exception('HTTP Error: '.$errorHTTP);
		}
		
		// Decode
		$responseDecoded = $this->_responseDecode($response);
		return $responseDecoded;
	}
	
	/**
	 * Response Decode.
	 * \fn _responseDecode($response)
	 * 
	 * @param string $response;
	 * @return array $response;
	 */
	private function _responseDecode($response) {
		return json_decode($response, RETURN_TYPE);
	}
	
	/**
	 * Request.
	 * \fn _request($url, $post = FALSE, $options = FALSE)
	 * 
	 * @param string $url;
	 * @param bool $post;
	 * @param bool $options;
	 * @return array $http_response_header, $response;
	 */
	private function _request($url, $post = FALSE, $options = FALSE) {
		$response = @file_get_contents(
			$url,
			FALSE,
			$this->_requestContext($post, $options)
		);
		
		return $this->_responseSuccess($http_response_header, $response);
	}
	
	/**
	 * Request Stream.
	 * \fn _requestStream($url, $post = FALSE, $options = FALSE)
	 * 
	 * @param string $url;
	 * @param bool $post;
	 * @param bool $options;
	 * @return void;
	 */
	private function _requestStream($url, $post = FALSE, $options = FALSE) {
		$handle = fopen(
			$url, 
			'r', 
			FALSE, 
			$this->_requestContext($post, $options)
		);
		
		$firstLine = fgets($handle);
		$this->_responseSuccess($http_response_header, $firstLine);
		
		// No errors detected, stream the output
		echo $firstLine;
		fpassthru($handle);
		fclose($handle);
	}
	
	/**
	 * Call function.
	 * \fn __call($method, $args)
	 * 
	 * @param string $method;
	 * @param string $args;
	 * @return array $url.$query, $post;
	 */
	public function __call($method, $args) {
		if (!isset($this->_api[$method])) {
			throw new Exception('Unknown method: '.$method);
		}
		
		// Handle overlapping methods (see: https://github.com/ScadaExposure/Shodan-PHP-REST-API#handle-overlapping-methods)
		$url = preg_replace_callback(
			'|\_.*$|',
			function ($matches) {
    				return "";
			},
			$method
		);
		
		// Generate the URL for the call
		$url = preg_replace_callback(
			'|([A-Z])|',
			function ($matches) {
    				return "/".strtolower($matches[0]);
			},
			$url
		);		

		// Detect API backend
		if ($this->_api[$method]['rest'] == self::REST_API) {
			$url = $this->apiUrl.$url;
		} elseif ($this->_api[$method]['rest'] == self::REST_EXPLOIT) {
			$url = $this->exploitUrl.$url;
		} else {
			$url = $this->streamUrl.$url;
		}
		
		// Compose query string
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
			return $this->_requestStream($url.$query, $post);
		}
		
		return $this->_request($url.$query, $post);
	}
	
	/**
	 * Get Apis.
	 * \fn getApis()
	 * 
	 * @return $_api;
	 */
	public function getApis() {
		return $this->_api;
	}
}
