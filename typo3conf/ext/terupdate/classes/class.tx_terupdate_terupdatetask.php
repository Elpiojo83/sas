<?php
/***************************************************************
*  Copyright notice
*
*  (c) 2010 Josef Florian Glatz <josef@josdesign.at>
*  All rights reserved
*
*
*  This script is part of the TYPO3 project. The TYPO3 project is
*  free software; you can redistribute it and/or modify
*  it under the terms of the GNU General Public License as published by
*  the Free Software Foundation; either version 2 of the License, or
*  (at your option) any later version.
*
*  The GNU General Public License can be found at
*  http://www.gnu.org/copyleft/gpl.html.
*
*  This script is distributed in the hope that it will be useful,
*  but WITHOUT ANY WARRANTY; without even the implied warranty of
*  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
*  GNU General Public License for more details.
*
*  This copyright notice MUST APPEAR in all copies of the script!
***************************************************************/

/**
 * Class "tx_terupdate_TerUpdateTask" provides task procedures
 *
 * @author		Josef Florian Glatz <josef@josdesign.at>
 * @author		Klaus Hoermann <klaus@3b-solutions.net>
 * @package		TYPO3
 * @subpackage		tx_terupdate
 *
 */
class tx_terupdate_TerUpdateTask extends tx_scheduler_Task {

	/**
	 * Function executed from the Scheduler.
	 * updates extension list against TER
	 *
	 * @return	boolean	TRUE if success, otherwise FALSE
	 */
	public function execute() {
				// set $success to 0
			$success = false;
				// needed phpfiles
			require_once(PATH_typo3 . 'template.php');
			require_once(PATH_typo3 . '/mod/tools/em/class.em_index.php');
			
			$extensionManager = t3lib_div::makeInstance('SC_mod_tools_em_index');
			$extensionManager->init();
			
			
			if (empty($extensionManager->MOD_SETTINGS['mirrorListURL'])) {
				$extensionManager->MOD_SETTINGS['mirrorListURL'] = $GLOBALS['TYPO3_CONF_VARS']['EXT']['em_mirrorListURL'];
			}
			$extension->MOD_SETTINGS['rep_url'] = 'http://typo3.org/fileadmin/ter/';
			$extensionManager->fetchMetaData('extensions');
			
				// set $success to 1
			$success = true;
			
			return $success;
	}

}

if (defined('TYPO3_MODE') && $TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/terupdate/classes/class.tx_terupdate_terupdatetask.php'])	{
	include_once($TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/terupdate/classes/class.tx_terupdate_terupdatetask.php']);
}

?>
