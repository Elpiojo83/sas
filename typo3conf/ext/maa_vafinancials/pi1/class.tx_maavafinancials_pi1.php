<?php
/***************************************************************
 *  Copyright notice
 *
 *  (c) 2012 Martin Aarhof <martin.aarhof@gmail.com>
 *  All rights reserved
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

// require_once(PATH_tslib . 'class.tslib_pibase.php');

/**
 * Plugin 'VAFinancials' for the 'maa_vafinancials' extension.
 *
 * @author	Martin Aarhof <martin.aarhof@gmail.com>
 * @package	TYPO3
 * @subpackage	tx_maavafinancials
 */
class tx_maavafinancials_pi1 extends tslib_pibase {
	public $prefixId      = 'tx_maavafinancials_pi1';		// Same as class name
	public $scriptRelPath = 'pi1/class.tx_maavafinancials_pi1.php';	// Path to this script relative to the extension dir.
	public $extKey        = 'maa_vafinancials';	// The extension key.
	public $pi_checkCHash = TRUE;

    public function load(array $conf)
    {
        $this->pi_initPIflexForm();
        $this->conf = $conf;
        $this->pi_setPiVarDefaults();
        $this->pi_loadLL();
    }
	
	/**
	 * The main method of the Plugin.
	 *
	 * @param string $content The Plugin content
	 * @param array $conf The Plugin configuration
	 * @return string The content that is displayed on the website
	 */
	public function main($content, array $conf) {
        $this->load($conf);

        require_once dirname(__FILE__) . '/../methods/methods.php';

        $key = $this->cObj->data['pi_flexform']['data']['sDEF']['lDEF']['dynField']['vDEF'];
        if (array_key_exists($key, tx_maavafinancials_methods::$types)) {
            $method = tx_maavafinancials_methods::$types[$key];
            if (!array_key_exists('class', $method)) {
                $method['class'] = 'vafinancials_' . $key;
            }

            if (!array_key_exists('file', $method)) {
                $method['file'] = $key . '.php';
            }

            if (!array_key_exists('init', $method)) {
                $method['init'] = 'init';
            }

            require_once dirname(__FILE__) . '/../methods/' . $method['file'];
            $o = new $method['class']($method, $this);
            $content = $o->$method['init']();
            return $this->pi_wrapInBaseClass($content);

        } else {
            throw new Exception('Method "' . $key . '" does not exists');
        }


	}

}



if (defined('TYPO3_MODE') && isset($GLOBALS['TYPO3_CONF_VARS'][TYPO3_MODE]['XCLASS']['ext/maa_vafinancials/pi1/class.tx_maavafinancials_pi1.php'])) {
	include_once($GLOBALS['TYPO3_CONF_VARS'][TYPO3_MODE]['XCLASS']['ext/maa_vafinancials/pi1/class.tx_maavafinancials_pi1.php']);
}

?>