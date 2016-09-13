<?php 

/*
 * Shodan Host
 */
echo $colors->getColoredString('IP SEARCH:', 'black', 'green');
try {
	var_dump($client->ShodanHost(array(
		'ip' => '69.171.230.68', // https://www.facebook.com/
	)));
} catch (Exception $e) {
	echo $e->getMessage()."\n";
}

echo $colors->getColoredString('IP SEARCH WITH HISTORY:', 'black', 'green');
try {
	var_dump($client->ShodanHost(array(
		'ip' => '69.171.230.68',
		'history' => TRUE,
	)));
} catch (Exception $e) {
	echo $e->getMessage()."\n";
}

echo $colors->getColoredString('IP SEARCH WITH MINIFY:', 'black', 'green');
try {
	var_dump($client->ShodanHost(array(
		'ip' => '69.171.230.68',
		'minify' => TRUE,
	)));
} catch (Exception $e) {
	echo $e->getMessage()."\n";
}

echo $colors->getColoredString('IP SEARCH WITH HISTORY AND !MINIFY:', 'black', 'green');
try {
	var_dump($client->ShodanHost(array(
		'ip' => '69.171.230.68',
		'history' => TRUE,
		'minify' => FALSE,
	)));
} catch (Exception $e) {
	echo $e->getMessage()."\n";
}

echo $colors->getColoredString('IP SEARCH WITH !HISTORY AND MINIFY:', 'black', 'green');
try {
	var_dump($client->ShodanHost(array(
		'ip' => '69.171.230.68',
		'history' => FALSE,
		'minify' => TRUE,
	)));
} catch (Exception $e) {
	echo $e->getMessage()."\n";
}
