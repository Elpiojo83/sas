<?php

$_EXTKEY = 'maa_vafinancials';

return array(
    'tx_maavafinancials_cron' => t3lib_extMgm::extPath($_EXTKEY, 'tx_maavafinancials_cron.php'),
    'tx_maavafinancials_pi1' => t3lib_extMgm::extPath($_EXTKEY, 'pi1/class.tx_maavafinancials_pi1.php'),
    'tx_maavafinancials_methods' => t3lib_extMgm::extPath($_EXTKEY, 'methods/methods.php'),
    'vafinancials_abstract' => t3lib_extMgm::extPath($_EXTKEY, 'methods/abstract.php'),
);