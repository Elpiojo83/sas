<?php
/**
 * Created by JetBrains PhpStorm.
 * User: LsV
 * Date: 08-08-12
 * Time: 02:27
 * To change this template use File | Settings | File Templates.
 */
abstract class vafinancials_abstract
{

    protected $method;
    protected $parent;

    public function __construct(array $method, tx_maavafinancials_pi1 $parent)
    {
        $this->method = $method;
        $this->parent = $parent;
    }

    public function init()
    {
        if (array_key_exists('iframe', $this->method)) {
            return $this->iframe($this->method['iframe']);
        }
    }

    protected function iframe(array $attr)
    {
        $attr = array_merge(array(
            'seamless' => 'seamless',
            'width' => '100%'
        ), $attr);

        $attributes = array();
        foreach($attr AS $k => $v) {
            if ($k == 'src') { $v = $this->setAirportUrl($v); }
            $attributes[] = $k . '="' . $v . '"';
        }

        return '<iframe ' . implode(' ', $attributes) . '></iframe>';
    }

    protected function setAirportUrl($url)
    {
        return str_replace('__ID__', $this->parent->conf['airlineID'], $url);
    }

    protected function fillTable(array $data, $class = '')
    {
        $file = $this->parent->cObj->fileResource($this->parent->conf['tableTemplate']);
        $template = $this->parent->cObj->getSubpart($file, '###TABLE###');
        $item = $this->parent->cObj->getSubpart($template, '###ITEM###');

        $markers = array();

        foreach($data AS $v) {
            $submarkers = array();
            $submarkers['###KEY###'] = $v['key'];
            $submarkers['###VAL###'] = $v['data'];
            $markers['###CONTENT###'] .= $this->parent->cObj->substituteMarkerArray($item, $submarkers);
        }

        $template = str_replace('###CLASS###', $class, $template);
        return $this->parent->cObj->substituteSubpartArray($template, $markers);

    }

    protected function loadData()
    {
        return file_get_contents($this->setAirportUrl($this->method['url']));
    }

}
