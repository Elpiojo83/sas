<?php

if (!defined ('TYPO3_MODE')) {
	die ('Access denied.');
}

	// Register information for the task
$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['scheduler']['tasks']['tx_terupdate_TerUpdateTask'] = array(
	'extension'        => $_EXTKEY,
	'title'            => 'LLL:EXT:' . $_EXTKEY . '/locallang.xml:scheduler.terupdateTask.name',
	'description'      => 'LLL:EXT:' . $_EXTKEY . '/locallang.xml:scheduler.terupdateTask.description',
	'additionalFields' => 'tx_terupdate_TerUpdateTask_additionalfieldprovider'
);

?>
