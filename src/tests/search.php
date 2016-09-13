<?php

/*
 * Shodan Host Search without filters - DON'T REQUIRE PAID API KEY
 */
echo $colors->getColoredString('SHODAN HOST SEARCH WITH FILTERS:', 'black', 'green');
try {
	var_dump($client->ShodanHostSearch(array(
		'query' => 'Niagara Web Server',
	)));
} catch (Exception $e) {
	echo $e->getMessage()."\n";
}

/*
 * Shodan Host Search with filters - REQUIRE PAID API KEY
 */
echo $colors->getColoredString('SHODAN HOST SEARCH WITH FILTERS:', 'black', 'green');
try {
	var_dump($client->ShodanHostSearch(array(
		'query' => 'Niagara Web Server country:"IT"',
	)));
} catch (Exception $e) {
	echo $e->getMessage()."\n";
}

/*
 * Shodan Host Search Tokens
 */
echo $colors->getColoredString('SHODAN HOST SEARCH TOKENS:', 'black', 'green');
try {
	var_dump($client->ShodanHostSearchTokens(array(
		'query' => 'Niagara Web Server country:"IT"',
	)));
} catch (Exception $e) {
	echo $e->getMessage()."\n";
}
