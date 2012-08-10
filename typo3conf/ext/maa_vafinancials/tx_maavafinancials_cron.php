<?php

class tx_maavafinancials_cron
    extends tx_scheduler_Task
{

    public function execute()
    {

        $extkey = 'maa_vafinancials';

        $config = t3lib_div::makeInstance('t3lib_TSparser'); /* @var $config t3lib_TSparser */
        $configTS = $config->checkIncludeLines('<INCLUDE_TYPOSCRIPT:source="FILE:EXT:' . $extkey . '/static/vafinancials/setup.txt">');
        $config->parse($configTS);

        $conf = $config->setup['plugin.']['tx_maavafinancials_pi1.'];

        $types = tx_maavafinancials_methods::$types;
        foreach($types AS $key => $type) {
            if (array_key_exists('cron', $type) && $type['cron'] === true) {
                $o = new tx_maavafinancials_pi1;
                $o->main('', $conf, $key);
            }
        }

        return true;
    }

}
