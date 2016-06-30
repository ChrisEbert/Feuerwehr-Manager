<?php

/**
 * Backend modules
 */
$GLOBALS['BE_MOD']['fwm'] = array(
	'alerts' => array(
		'tables' 			=> array('tl_alert_archive', 'tl_alert'),
        'icon'   			=> 'system/modules/feuerwehr_manager/assets/images/fire.png',
        'stylesheet' 		=> 'system/modules/feuerwehr_manager/assets/css/be_style.css',
        'statisticYear' 	=> array('BeModuleAlertStatisticYear', 'compile'),
        'statisticTotal' 	=> array('BeModuleAlertStatisticTotal', 'compile')       
	)
);


/**
 * Frontend modules
 */
array_insert($GLOBALS['FE_MOD'],3, array 
( 
    'fwm' => array 
    ( 
        'fwm_alertArchive'   		=> 'ModuleAlertArchive',
        'fwm_alertArchiveMenu'	  	=> 'ModuleAlertArchiveMenu',
        'fwm_alertArchiveReader' 	=> 'ModuleAlertArchiveReader',
        'fwm_alertLast' 			=> 'ModuleAlertLastAlert',
        'fwm_alertGalleryViewer' 	=> 'ModuleAlertGalleryViewer',
        'fwm_alertStatisticReader' 	=> 'ModuleAlertStatisticReader',
        'fwm_alertStatisticYears' 	=> 'ModuleAlertStatisticYears',
        'fwm_alertMap' 	            => 'ModuleAlertMap'
)
));  


/**
 * Content elements
 */
$GLOBALS['TL_CTE']['fwm'] = array(
	'fwm_alertStatistic' => 'ContentAlertStatistic'
);

$GLOBALS['BE_FFL']['searchMap'] = 'SearchMap';

$GLOBALS['TL_HOOKS']['simpleAjaxFrontend'][] = array('AlertDetails', 'getDetails');