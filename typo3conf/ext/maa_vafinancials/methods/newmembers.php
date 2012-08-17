<?php
/**
 * Created by JetBrains PhpStorm.
 * User: LsV
 * Date: 08-08-12
 * Time: 02:26
 * To change this template use File | Settings | File Templates.
 */
class vafinancials_newmembers
    extends vafinancials_abstract
{

    public function init()
    {

        $data = $this->loadData();
        $xml = simplexml_load_string($data);

        $data = array();
        foreach($xml->pilot AS $pilot) {
            $data[] = array(
                'key' => (string)$this->setCountry((string)$pilot->country),
                'data' => '<b>' . (string)$pilot->name . '</b><br />' . (string)$pilot->callsign
            );
        }

        return $this->fillListTable($data, 'newmembers');

    }

    private function setCountry($c)
    {
        $c = explode('/', $c);
        $c = strtolower(str_replace('.png', '', $c[count($c)-1]));
        return '<span class="t3-icon-flags t3-icon-' . $c . '">&nbsp;</span>';
        //return '<img src="' . $c . '" alt="" />';
    }

}
