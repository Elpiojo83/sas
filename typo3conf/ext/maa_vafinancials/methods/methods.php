<?php
/**
 * Created by JetBrains PhpStorm.
 * User: LsV
 * Date: 08-08-12
 * Time: 01:46
 * To change this template use File | Settings | File Templates.
 */

require_once dirname(__FILE__) . '/../pi1/class.tx_maavafinancials_pi1.php';

class tx_maavafinancials_methods
    extends tx_maavafinancials_pi1
{

    static public $types = array(
        'newmembers' => array(
            'url' => 'http://www.vafinancials.com/v5/plugins/app/x_newpilots.php?id=__ID__',
        ),
        'statistics' => array(
            'url' => 'http://www.vafinancials.com/vadata/vadetail.php?id=__ID__'
        ),
        'flightboard' => array(
            'iframe' => array(
                'src' => 'http://www.vafinancials.com/v5/plugins/flightboard.php?id=__ID__',
                'height' => '200px',
            )
        ),
        'news' => array(
            'url' => 'http://www.vafinancials.com/rio/rio_news_get.php?id=__ID__',
            'cron' => true,
        ),
        'fleetinfo' => array(
            'iframe' => array(
                'src' => 'http://www.vafinancials.com/v5/plugins/vafs_plugin_fleet.php?id=__ID__',
                'height' => '503px'
            )
        ),
        'routesinfo' => array(
            'iframe' => array(
                'src' => 'http://www.vafinancials.com/v5/plugins/vafs_plugin_routes.php?id=__ID__',
                'height' => '503px',
            )
        ),
        'ranks' => array(
            'url' => 'http://www.vafinancials.com/v5/plugins/app/x_ranks_start.php?id=__ID__',
			'rank' => 'http://www.vafinancials.com/v5/plugins/app/x_ranks_data.php?id=__ID__'
        ),
        'roster' => array(
			'iframe' => array(
				'src' => 'http://www.vafinancials.com/v5/plugins/vafs_plugin_roster.php?id=__ID__',
				'height' => '503px',
			)
        ),
        'pilotperformance' => array(
            'iframe' => array(
				'src' => 'http://www.vafinancials.com/v5/plugins/vafs_plugin_pilotperf.php?id=__ID__',
				'height' => '503px'
			)
        ),
        'lastten' => array(
            'url' => 'http://www.vafinancials.com/v5/plugins/app/x_lastten.php?id=__ID__'
        ),
        'airlineperformance' => array(
            'xml' => 'http://www.vafinancials.com/v5/plugins/app/x_vamonth_perf.php?id=__ID__'
        ),
        'registerform' => array(
            'iframe' => array(
                'src' => 'http://www.vafinancials.com/v5/newplugins/pilotapp.php?id=__ID__',
                'height' => '600px'
            )
        )
    );

    public function methods($config)
    {

        $this->load(array());

        $list = array();
        foreach(self::$types AS $k => $a) {
            if (!array_key_exists('cron', $a) || !$a['cron']) {
                $list[] = array(
                    0 => $this->pi_getLL('menu_' . $k),
                    1 => $k
                );
            }
        }

        $config['items'] = array_merge($config['items'], $list);
        return $config;
    }

}
