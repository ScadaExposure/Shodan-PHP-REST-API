<?php

/*
 * Crawl a network request - REQUIRE PAID API KEY
 */
echo $colors->getColoredString('CRAWL A NETWORK:', 'black', 'green');
try {
	var_dump($client->ShodanScan(array(
		'ips' => '69.171.230.0/24',
	)));
} catch (Exception $e) {
	echo $e->getMessage()."\n";
}

/*
 * Crawl internet by port and protocol request - REQUIRE PAID API KEY AND SHODAN PERMISSION
 */
echo $colors->getColoredString('CRAWL INTERNET BY PORT AND PROTOCOL:', 'black', 'green');
try {
	var_dump($client->ShodanScanInternet(array(
		'port' => '80',
		'protocol' => 'dns-tcp',
	)));
} catch (Exception $e) {
	echo $e->getMessage()."\n";
}

/*
 * Status of requested scan
 */
echo $colors->getColoredString('STATUS OF REQUESTED SCAN:', 'black', 'green');
try {
	var_dump($client->ShodanScan_Id(array(
		'id' => '4I1LK2YHAY3PLWJ6',
	)));
} catch (Exception $e) {
	echo $e->getMessage()."\n";
}

/*
 * Services crawled
 */
echo $colors->getColoredString('SERVICES CRAWLED:', 'black', 'green');
try {
	var_dump($client->ShodanServices());
} catch (Exception $e) {
	echo $e->getMessage()."\n";
}

