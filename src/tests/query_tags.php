<?php

/*
 * List of users saved query tags
 */
echo $colors->getColoredString('USERS SAVED QUERY TAGS:', 'black', 'green');
try {
	var_dump($client->ShodanQueryTags(array(
		'size' => '30',
	)));
} catch (Exception $e) {
	echo $e->getMessage()."\n";
}

