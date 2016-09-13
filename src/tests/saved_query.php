<?php

/*
 * Other users saved query
 */
echo $colors->getColoredString('SAVED SEARCH QUERY:', 'black', 'green');
try {
	var_dump($client->ShodanQuery(array(
		'page' => '1', 
	)));
} catch (Exception $e) {
	echo $e->getMessage()."\n";
}

/*
 * Search for other users saved query
 */
echo $colors->getColoredString('SEARCH FOR OTHER USERS SAVED QUERY:', 'black', 'green');
try {
	var_dump($client->ShodanQuery(array(
		'query' => 'fax',
	)));
} catch (Exception $e) {
	echo $e->getMessage()."\n";
}
