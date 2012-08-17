<?php
/**
 * Created by JetBrains PhpStorm.
 * User: LsV
 * Date: 08-08-12
 * Time: 02:26
 * To change this template use File | Settings | File Templates.
 */
class vafinancials_statistics
    extends vafinancials_abstract
{

    protected $table;

    public function init()
    {

        $data = $this->loadData();
        require_once dirname(__FILE__) . '/../3rdparty/phpQuery/phpQuery/phpQuery.php';
        phpQuery::newDocumentHTML($data);
        $this->table = pq('table table');

        $cargo_pounds = (float)trim(pq('tr:eq(5) td:eq(1)', $this->table)->html());
        $cargo_kgs = $cargo_pounds * 0.453592;
        $cargo_tons = $cargo_kgs / 1000;
        $cargo_thousandtons = $cargo_tons / 1000;

        $miles = (float)trim(pq('tr:eq(3) td:eq(1)', $this->table)->html());

        $data = array(
            $this->addData('stats_pilots', 'tr:eq(0) td:eq(1)'),
            $this->addData('stats_flights', 'tr:eq(1) td:eq(1)'),
            $this->addData('stats_hours', 'tr:eq(2) td:eq(1)', 2),
            $this->addData('stats_miles', $miles),
            $this->addData('stats_km', round($miles * 1.60934, 2)),
            $this->addData('stats_passengers', 'tr:eq(4) td:eq(1)'),
            $this->addData('stats_cargo_tons', round($cargo_tons, 2))
        );

        return $this->fillListTable($data, 'stats');

    }

    private function addData($k, $v, $round = 0)
    {
        if (is_string($v)) {
            $data = round((float)trim(pq($v, $this->table)->html()));
        } else {
            $data = $v;
        }

        return array(
            'key' => $this->parent->pi_getLL($k),
            'data' => $data
        );
    }

}
