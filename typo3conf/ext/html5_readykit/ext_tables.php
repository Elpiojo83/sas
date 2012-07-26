<?php
if (!defined('TYPO3_MODE')) {
	die ('Access denied.');
}
t3lib_extMgm::addStaticFile($_EXTKEY,'static/html5_readykit_config/', 'HTML5 Readykit (config)');
t3lib_extMgm::addStaticFile($_EXTKEY,'static/html5_readykit_includes/', 'HTML5 Readykit (includes)');
?>