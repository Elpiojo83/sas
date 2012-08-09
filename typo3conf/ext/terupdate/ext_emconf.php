<?php

########################################################################
# Extension Manager/Repository config file for ext "terupdate".
#
# Auto generated 28-07-2012 19:15
#
# Manual updates:
# Only the data in the array - everything else is removed by next
# writing. "version" and "dependencies" must not be touched!
########################################################################

$EM_CONF[$_EXTKEY] = array(
	'title' => 'TER Update Task',
	'description' => 'Update the TER using a scheduler task called >TER Update<. (needs TYPO3 4.3 or higher & sysext scheduler)',
	'category' => 'misc',
	'shy' => 0,
	'version' => '1.0.5',
	'dependencies' => '',
	'conflicts' => '',
	'priority' => '',
	'loadOrder' => '',
	'module' => '',
	'state' => 'stable',
	'uploadfolder' => 0,
	'createDirs' => '',
	'modify_tables' => '',
	'clearcacheonload' => 0,
	'lockType' => '',
	'author' => 'Josef Florian Glatz',
	'author_email' => 'josef@josdesign.at',
	'author_company' => 'josdesign.at - werbestudio fuer neue medien',
	'CGLcompliance' => '',
	'CGLcompliance_note' => '',
	'constraints' => array(
		'depends' => array(
			'php' => '5.2.0-0.0.0',
			'typo3' => '4.3.dev-4.4.6',
		),
		'conflicts' => array(
		),
		'suggests' => array(
		),
	),
	'_md5_values_when_last_written' => 'a:11:{s:9:"ChangeLog";s:4:"3a2f";s:16:"ext_autoload.php";s:4:"8655";s:12:"ext_icon.gif";s:4:"dcdc";s:12:"ext_icon.png";s:4:"2dc8";s:17:"ext_localconf.php";s:4:"a89b";s:14:"ext_tables.php";s:4:"8b8c";s:13:"locallang.xml";s:4:"002f";s:10:"README.txt";s:4:"f383";s:44:"classes/class.tx_terupdate_terupdatetask.php";s:4:"9d00";s:68:"classes/class.tx_terupdate_terupdatetask_additionalfieldprovider.php";s:4:"37e3";s:14:"doc/manual.sxw";s:4:"706f";}',
);

?>