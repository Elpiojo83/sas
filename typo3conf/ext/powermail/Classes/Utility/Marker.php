<?php

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2012 Alex Kellner <alexander.kellner@in2code.de>, in2code.de
 *  
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 3 of the License, or
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
 * Class to extend Pi1 field marker e.g. {firstname}
 *
 * @package powermail
 * @license http://www.gnu.org/licenses/lgpl.html GNU Lesser General Public License, version 3 or later
 *
 */
class Tx_Powermail_Utility_Marker {

	/**
	 * Create individual marker for powermail field
	 *
	 * @param	array	Config Array
	 * @param	object	Parent Object
	 * @return	string	String to render
	 */
	public function createMarker($PA, $fobj) {
		$content = '';
		if (isset($PA['row']['marker']) && !empty($PA['row']['marker'])) { // if entry in db
			$marker = $PA['row']['marker'];
		} else { // no entry
			$marker = $PA['row']['title'];
		}
		$marker = preg_replace('/[^a-zA-Z0-9_-]/', '', $marker);
		$marker = str_replace(array('-'), '_', $marker);
		$marker = strtolower($marker);

		if (stristr($PA['row']['uid'], 'NEW')) { // field just generated
			$content .= '<div style="background-color: #F4DA5C; padding: 5px 10px;">';
			$content .= 'Please save before...';
			$content .= '</div>';
		} else { // was saved before
			$content .= '<div style="background-color: #ddd; padding: 5px 10px;" />';
			$content .= '{' . strtolower($marker) . '}';
			$content .= '</div>';
			$content .= '<input type="hidden" name="data[tx_powermail_domain_model_fields][' . $PA['row']['uid'] . '][marker]" value="' . strtolower($marker) . '" />';
		}

		return $content;
	}

	/**
	 * Workarround to only show a label and no field in TCA
	 *
	 * @param	array	Config Array
	 * @param	object	Parent Object
	 * @return	empty string
	 */
	public function doNothing($PA, $fobj) {
		return '';
	}
}
?>