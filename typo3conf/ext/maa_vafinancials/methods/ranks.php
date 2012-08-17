<?php
/**
 * Created by JetBrains PhpStorm.
 * User: LsV
 * Date: 08-08-12
 * Time: 02:26
 * To change this template use File | Settings | File Templates.
 */
class vafinancials_ranks
	extends vafinancials_abstract
{

	public function init()
	{

		/*
		if (t3lib_div::_GET('rank') != '') {
			$this->method['url'] = $this->method['rank'];
			$data = $this->loadData();
			$xml = simplexml_load_string($data);

			$content = '<table class="table table-striped table-condensed maa_vafinancials_table maa_vafinancials_ranks maa_vafinancials_ranks_data">';
				$content .= '<thead>';
				$content .= '<tr>';
					$content .= '<th>' . (string)$xml->rank->row->rankname . '</th>';
					$content .= '<th>' . (string)$xml->rank->row->rankimg . '</th>';
					$content .= '<th>' . (string)$xml->rank->row->hourslo . '</th>';
					$content .= '<th>' . (string)$xml->rank->row->hourshi . '</th>';
					$content .= '<th>' . (string)$xml->rank->row->salary . '</th>';
					$content .= '<th>' . (string)$xml->rank->row->mhours . '</th>';
					$content .= '<th>' . (string)$xml->rank->row->special . '</th>';
				$content .= '</tr>';
				$content .= '</thead>';
				$content .= '<tbody>';
					foreach($xml->pilots AS $pilot) {
						$content .= '<tr>';
							$content .= '<td colspan="2">' . (string)$pilot->pilot->callsign . '</td>';
							$content .= '<td colspan="3">' . (string)$pilot->pilot->name . '</td>';
							$content .= '<td colspan="2">' . (string)$pilot->pilot->hours . '</td>';
						$content .= '</tr>';
					}
				$content .= '</tbody>';
				$content .= '<tfooter>';
					$content .= '<tr>';
						$content .= '<td colspan="7">' . (string)$xml->rank->row->certs . '</td>';
					$content .= '</tr>';
				$content .= '</tfooter>';

			$content .= '</table>';

			return $content;
		}
		*/


		$content = '<table class="table table-striped table-condensed maa_vafinancials_table maa_vafinancials_ranks">';
		$xmlfields = array();

		$data = $this->loadData();
		$xml = simplexml_load_string($data);

		$content .= '<thead>';
		$content .= '<tr>';
		foreach($xml->metadata->column AS $header) { /** @var $header SimpleXMLElement */
			$attr = $header->attributes();
			switch((string)$attr['label']) {
				default:
					$content .= '<th>' . (string)$attr['label'] . '</th>';
					$xmlfields[] = array(
						'field' => (string)$attr['name'],
						'type' => (string)$attr['datatype']
					);
					break;
				case 'Rank Img':
					$content .= '<th>&nbsp;</th>';
					$xmlfields[] = array(
						'field' => (string)$attr['name'],
						'type' => (string)$attr['datatype']
					);
					break;
				case 'OT Hours':
					break;
			}
		}
		$content .= '</tr>';
		$content .= '</thead>';

		$content .= '<tbody>';
		foreach($xml->data->row AS $row) { /** @var $row SimpleXMLElement */
			$content .= '<tr>';
			foreach($xmlfields AS $field) {
				$attr = $row->attributes();
				switch ($field['type']) {
					default:
					case 'string':
					case 'html':
						/*if ($field['field'] == 'rankname') {
							$out = '<a href="' . $_SERVER['REQUEST_URI'] . '?rank=' . $attr['id'] . '">' . (string)$row->{$field['field']} . '</a>';
						} else {*/
							$out = (string)$row->{$field['field']};
						//}
						break;

					case 'double':
						$out = (float)$row->{$field['field']};
						break;
					case 'special':
						$out = ((string)$row->{$field['field']} == 'NO' ? false : true);
						break;

				}

				$content .= '<td>' . $out . '</td>';
			}
			$content .= '</tr>';
		}
		$content .= '</tbody>';

		$content .= '</table>';

		return $content;

	}
}
