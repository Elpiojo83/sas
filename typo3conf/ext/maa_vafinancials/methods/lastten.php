<?php
/**
 * Created by JetBrains PhpStorm.
 * User: LsV
 * Date: 08-08-12
 * Time: 02:26
 * To change this template use File | Settings | File Templates.
 */
class vafinancials_lastten
    extends vafinancials_abstract
{

	public function init()
	{

		$data = $this->loadData();
		$xml = simplexml_load_string($data);

		$headers = array(/*'Flight ID', */'', 'Flight', 'Type', 'Depart', 'Arrive', 'Pilot', 'Pax', 'Cargo (tons)', 'Aircraft', 'Date');

		$data = array();
		foreach($xml->flight AS $log) {
			$data[] = array(
				/*$log->flightid,*/
				'<a href="' . (string)$log->flightlog . '">PIREP</a>',
				(string)$log->flightnum,
				(string)$log->ftype,
				(string)$log->departed,
				(string)$log->arrived,
				(string)$log->pilot,
				(string)$log->pax,
				/*$log->cargo,*/
				round((float)$log->cargokg / 1000, 2),
				(string)$log->aircraft,
				DateTime::createFromFormat('M d Y', (string)$log->fdate)->format('d-m-Y'),
			);
		}

		return $this->fillTable($data, $headers, null, 'lastten');


	}

}
