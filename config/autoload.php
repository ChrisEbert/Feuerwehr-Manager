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
	'AlertDetails'                => 'system/modules/feuerwehr_manager/AlertDetails.php',
	'BeModuleAlertStatisticTotal' => 'system/modules/feuerwehr_manager/BeModuleAlertStatisticTotal.php',
	'BeModuleAlertStatisticYear'  => 'system/modules/feuerwehr_manager/BeModuleAlertStatisticYear.php',
	// Classes
	'Contao\Alert'                => 'system/modules/feuerwehr_manager/classes/Alert.php',
	'Contao\AlertFbBot'                  => 'system/modules/feuerwehr_manager/classes/AlertFbBot.php',
	'ContentAlertStatistic'       => 'system/modules/feuerwehr_manager/ContentAlertStatistic.php',
	'DataContainerStatistic'      => 'system/modules/feuerwehr_manager/DataContainerStatistic.php',
	'generateCharts'              => 'system/modules/feuerwehr_manager/generateCharts.php',

	// Models
	'Contao\FwmAlertsModel'       => 'system/modules/feuerwehr_manager/models/FwmAlertsModel.php',
	'Contao\FwmDepartmentsModel'  => 'system/modules/feuerwehr_manager/models/FwmDepartmentsModel.php',
	'Contao\FwmVehiclesModel'     => 'system/modules/feuerwehr_manager/models/FwmVehiclesModel.php',
	'ModuleAlertMap'              => 'system/modules/feuerwehr_manager/ModuleAlertMap.php',
	'ModuleAlertStatisticReader'  => 'system/modules/feuerwehr_manager/ModuleAlertStatisticReader.php',
	'ModuleAlertStatisticTotal'   => 'system/modules/feuerwehr_manager/ModuleAlertStatisticTotal.php',
	'ModuleAlertStatisticYear'    => 'system/modules/feuerwehr_manager/ModuleAlertStatisticYear.php',
	'ModuleAlertStatisticYears'   => 'system/modules/feuerwehr_manager/ModuleAlertStatisticYears.php',

	// Modules
	'Contao\ModuleAlertList'      => 'system/modules/feuerwehr_manager/modules/ModuleAlertList.php',
	'Contao\ModuleLastAlert'      => 'system/modules/feuerwehr_manager/modules/ModuleLastAlert.php',

	// Widgets
	'Contao\SearchMap'            => 'system/modules/feuerwehr_manager/widgets/SearchMap.php',
));


/**
 * Register the templates
 */
TemplateLoader::addFiles(array
(
	'be_alert_statistic_total' => 'system/modules/feuerwehr_manager/templates',
	'be_alert_statistic_year'  => 'system/modules/feuerwehr_manager/templates',
	'be_map_widget'            => 'system/modules/feuerwehr_manager/templates',
	'ce_alert_statistic'       => 'system/modules/feuerwehr_manager/templates',
	'fwm_alertDetailsMap'      => 'system/modules/feuerwehr_manager/templates',
	'fwm_alertMap'             => 'system/modules/feuerwehr_manager/templates',
	'fwm_alertStatisticReader' => 'system/modules/feuerwehr_manager/templates',
	'fwm_alertStatisticYears'  => 'system/modules/feuerwehr_manager/templates',
	'mod_fwm_alert_list'       => 'system/modules/feuerwehr_manager/templates',
	'mod_fwm_last_alert'       => 'system/modules/feuerwehr_manager/templates',
));
