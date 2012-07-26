<?php
// hook is called after Caching / pages with COA_/USER_INT objects. 
$TYPO3_CONF_VARS['SC_OPTIONS']['tslib/class.tslib_fe.php']['contentPostProc-output'][] = 
	'EXT:html5_readykit/class.html5_readykit.php:&user_html5_readykit->noCache';
	 
// hook is called before Caching / pages on their way in the cache.
$TYPO3_CONF_VARS['SC_OPTIONS']['tslib/class.tslib_fe.php']['contentPostProc-all'][] = 
	'EXT:html5_readykit/class.html5_readykit.php:&user_html5_readykit->cache';
	
// Call a hook in the t3lib_pagerenderer.php
$TYPO3_CONF_VARS['SC_OPTIONS']['t3lib/class.t3lib_pagerenderer.php']['render-postProcess'][] = 'EXT:html5_readykit/class.html5_readykit.php:user_html5_readykit->main';
?>
