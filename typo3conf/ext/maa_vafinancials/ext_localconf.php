<?php
if (!defined('TYPO3_MODE')) {
	die ('Access denied.');
}

t3lib_extMgm::addPItoST43($_EXTKEY, 'pi1/class.tx_maavafinancials_pi1.php', '_pi1', 'list_type', 1);

$TYPO3_CONF_VARS['SC_OPTIONS']['scheduler']['tasks'][$_EXTKEY] = array(
    'extension' => $_EXTKEY,
    'title' => 'VA Financials',
    'description' => 'Import several data from VA Financials',
);


?>