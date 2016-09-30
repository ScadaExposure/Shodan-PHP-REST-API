#!/usr/bin/php
<?php

require_once 'Colors.php';
require_once 'Shodan.php';

$key = 'Insert your API key here';
$client = new Shodan($key, TRUE);
$colors = new Colors();

// CLI

/**
 * Usage.
 * Auto-generate the usage for CLI.
 * 
 * @param string $client;
 * @return void;
 */
function usage($client) {
	echo 'Usage:'."\n";
	
	echo "\t".'-r, --run-tests'."\n";
	echo "\t".'-t, --run-test STRING'."\n";
	
	foreach ($client->getApis() as $method => $methodConf) {
		echo "\t".'-m, --method '.$method.' ';
		
		foreach ($methodConf as $parameter => $parameterConf) {
			if (
				$parameter == 'rest'
			) continue;
			
			if ($parameterConf['optional'] == Shodan::PARAMETER_OPTIONAL) echo '[';
			echo '--'.$parameter.' '.$parameterConf['type'];
			if ($parameterConf['optional'] == Shodan::PARAMETER_OPTIONAL) echo ']';
			echo ' ';
		}
		
		echo "\n";
	}
	
	exit(1);
}

$methodOptions = array();
foreach ($client->getApis() as $method => $methodConf) {
	foreach ($methodConf as $parameter => $parameterConf) {
		if (!in_array($parameter, $methodOptions)) {
			$methodOptions[] = $parameter.':';
		}
	}
}

$options = getopt('rt:m:', array_merge(array(
	'run-tests', // also known as "-r"
	'run-test:', // also known as "-t"
	'method:' // also known as "-m"
), $methodOptions));

// Run all the tests
if (
	isset($options['run-tests']) ||
	isset($options['r'])
) {
	foreach (glob('tests/*.php') as $test) {
		require_once $test;
	}

// Run a specific test
} elseif (
	isset($options['run-test']) ||
	isset($options['t'])
) {
	$test = FALSE;
	if (isset($options['run-test'])) $test = $options['run-test'];
	if (isset($options['t'])) $test = $options['t'];
	
	if (!$test) usage($client);
	
	if (!in_array('tests/'.$test.'.php', glob('tests/*.php'))) usage($client);
	
	require_once 'tests/'.$test.'.php';
	
// Run a specific method
} elseif (
	isset($options['method']) ||
	isset($options['m'])
) {
	$method = FALSE;
	if (isset($options['method'])) $method = $options['method'];
	if (isset($options['m'])) $method = $options['m'];
	
	if (!$method) usage($client);
	
	$methods = $client->getApis();
	if (!array_key_exists($method, $methods)) usage($client);
	
	$parameters = array();
	foreach ($methods[$method] as $parameter => $parameterConf) {
		if (
			$parameter == 'rest'
		) continue;
		
		// Check that all the mandatory parameters have been specified
		if (
			$parameterConf['optional'] == Shodan::PARAMETER_MANDATORY &&
			!isset($options[$parameter])
		) usage($client);
		
		if (isset($options[$parameter])) {
			$parameters[$parameter]  = $options[$parameter];
		}
	}
	
	echo json_encode($client->$method($parameters), JSON_PRETTY_PRINT)."\n";
	
// Display the usage
} else usage($client);
