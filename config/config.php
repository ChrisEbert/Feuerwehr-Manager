<?php

/**
 * Backend modules
 */
$GLOBALS['BE_MOD']['fwm'] = array(
	'alerts' => array
	(
		'tables' 					=> array('tl_fwm_alerts'),
	  'icon'   					=> 'system/modules/feuerwehr_manager/assets/images/fire.png',
	  'stylesheet' 			=> 'system/modules/feuerwehr_manager/assets/css/be_style.css',
	  'statisticYear' 	=> array('BeModuleAlertStatisticYear', 'compile'),
	  'statisticTotal' 	=> array('BeModuleAlertStatisticTotal', 'compile')
	),
	'departments' => array
	(
		'tables' 	=> array('tl_fwm_departments', 'tl_fwm_vehicles'),
		'icon' 		=> 'system/modules/feuerwehr_manager/assets/images/building.png'
	),
	'configuration' => array
	(
		'tables' => array('tl_fwm_configuration'),
		'icon'	 => 'system/modules/feuerwehr_manager/assets/images/settings.gif'
	)
);


/**
 * Frontend modules
 */
array_insert($GLOBALS['FE_MOD'], 3, array
(
  'fwm' => array
  (
		'fwm_last_alert' => 'ModuleLastAlert',
		'fwm_alert_list' => 'ModuleAlertList',
    'fwm_alertStatisticReader' 	=> 'ModuleAlertStatisticReader',
    'fwm_alertStatisticYears' 	=> 'ModuleAlertStatisticYears',
    'fwm_alertMap' 	            => 'ModuleAlertMap'
	)
));


/**
 * Content elements
 */
$GLOBALS['TL_CTE']['fwm'] = array
(
	'fwm_alertStatistic' => 'ContentAlertStatistic'
);

$GLOBALS['BE_FFL']['searchMap'] = 'SearchMap';

$GLOBALS['TL_HOOKS']['simpleAjaxFrontend'][] = array('AlertDetails', 'getDetails');
