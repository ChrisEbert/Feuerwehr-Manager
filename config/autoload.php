<?php

/**
 * Contao Open Source CMS
 *
 * Copyright (c) 2005-2017 Leo Feyer
 *
 * @license LGPL-3.0+
 */


/**
 * Register the classes
 */
ClassLoader::addClasses(array
(
	'AlertDetails'                => 'system/modules/feuerwehr-manager/AlertDetails.php',
	'BeModuleAlertStatisticTotal' => 'system/modules/feuerwehr-manager/BeModuleAlertStatisticTotal.php',
	'BeModuleAlertStatisticYear'  => 'system/modules/feuerwehr-manager/BeModuleAlertStatisticYear.php',
	// Classes
	'Contao\Alert'                => 'system/modules/feuerwehr-manager/classes/Alert.php',
	'ContentAlertStatistic'       => 'system/modules/feuerwehr-manager/ContentAlertStatistic.php',
	'DataContainerStatistic'      => 'system/modules/feuerwehr-manager/DataContainerStatistic.php',
	'generateCharts'              => 'system/modules/feuerwehr-manager/generateCharts.php',

	// Models
	'Contao\FwmAlertsModel'       => 'system/modules/feuerwehr-manager/models/FwmAlertsModel.php',
	'Contao\FwmDepartmentsModel'  => 'system/modules/feuerwehr-manager/models/FwmDepartmentsModel.php',
	'Contao\FwmVehiclesModel'     => 'system/modules/feuerwehr-manager/models/FwmVehiclesModel.php',
	'ModuleAlertMap'              => 'system/modules/feuerwehr-manager/ModuleAlertMap.php',
	'ModuleAlertStatisticReader'  => 'system/modules/feuerwehr-manager/ModuleAlertStatisticReader.php',
	'ModuleAlertStatisticTotal'   => 'system/modules/feuerwehr-manager/ModuleAlertStatisticTotal.php',
	'ModuleAlertStatisticYear'    => 'system/modules/feuerwehr-manager/ModuleAlertStatisticYear.php',
	'ModuleAlertStatisticYears'   => 'system/modules/feuerwehr-manager/ModuleAlertStatisticYears.php',

	// Modules
	'Contao\ModuleAlertList'      => 'system/modules/feuerwehr-manager/modules/ModuleAlertList.php',
	'Contao\ModuleLastAlert'      => 'system/modules/feuerwehr-manager/modules/ModuleLastAlert.php',

	// Widgets
	'Contao\SearchMap'            => 'system/modules/feuerwehr-manager/widgets/SearchMap.php',
));


/**
 * Register the templates
 */
TemplateLoader::addFiles(array
(
	'be_alert_statistic_total' => 'system/modules/feuerwehr-manager/templates',
	'be_alert_statistic_year'  => 'system/modules/feuerwehr-manager/templates',
	'be_map_widget'            => 'system/modules/feuerwehr-manager/templates',
	'ce_alert_statistic'       => 'system/modules/feuerwehr-manager/templates',
	'fwm_alertDetailsMap'      => 'system/modules/feuerwehr-manager/templates',
	'fwm_alertMap'             => 'system/modules/feuerwehr-manager/templates',
	'fwm_alertStatisticReader' => 'system/modules/feuerwehr-manager/templates',
	'fwm_alertStatisticYears'  => 'system/modules/feuerwehr-manager/templates',
	'mod_fwm_alert_list'       => 'system/modules/feuerwehr-manager/templates',
	'mod_fwm_last_alert'       => 'system/modules/feuerwehr-manager/templates',
));
