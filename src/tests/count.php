<?php

/*
 * Shodan Host Count
 */
echo $colors->getColoredString('SHODAN HOST COUNT:', 'black', 'green');
try {
	var_dump($client->ShodanHostCount(array(
		'query' => 'Niagara Web Server',
	)));
} catch (Exception $e) {
	echo $e->getMessage()."\n";
}

/*
 * Shodan Host Count with country IT
 */
echo $colors->getColoredString('SHODAN HOST COUNT WITH COUNTRY IT:', 'black', 'green');
try {
	var_dump($client->ShodanHostCount(array(
		'query' => 'Niagara Web Server country:"IT"',
	)));
} catch (Exception $e) {
	echo $e->getMessage()."\n";
}

/*
 * Shodan Host Count with country US
 */
echo $colors->getColoredString('SHODAN HOST COUNT WITH COUNTRY US:', 'black', 'green');
try {
	var_dump($client->ShodanHostCount(array(
		'query' => 'Niagara Web Server country:"US"',
	)));
} catch (Exception $e) {
	echo $e->getMessage()."\n";
}

/*
 * Shodan host count of top 10 countries
 */
echo $colors->getColoredString('SHODAN HOST COUNT OF TOP 10 COUNTRIES:', 'black', 'green');
try {
	var_dump($client->ShodanHostCount(array(
		'query' => 'Niagara Web Server',
		'facets' => 'country:10',
	)));
} catch (Exception $e) {
	echo $e->getMessage()."\n";
}
