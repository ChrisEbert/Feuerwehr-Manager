<?php

/**
 * Contao Open Source CMS
 *
 * Copyright (c) 2005-2017 Leo Feyer
 *
 * @license LGPL-3.0+
 */


/**
 * Register the namespaces
 */
ClassLoader::addNamespaces(array
(
	'Fwm',
));


/**
 * Register the classes
 */
ClassLoader::addClasses(array
(
	'ModuleAlertStatisticReader'  => 'system/modules/feuerwehr-manager/ModuleAlertStatisticReader.php',
	'DataContainerStatistic'      => 'system/modules/feuerwehr-manager/DataContainerStatistic.php',
	'BeModuleAlertStatisticTotal' => 'system/modules/feuerwehr-manager/BeModuleAlertStatisticTotal.php',
	// Classes
	'Contao\Alert'                => 'system/modules/feuerwehr-manager/classes/Alert.php',
	'Fwm\Filter'                  => 'system/modules/feuerwehr-manager/classes/Filter.php',
	'BeModuleAlertStatisticYear'  => 'system/modules/feuerwehr-manager/BeModuleAlertStatisticYear.php',
	'ModuleAlertStatisticTotal'   => 'system/modules/feuerwehr-manager/ModuleAlertStatisticTotal.php',

	// Models
	'Contao\FwmVehiclesModel'     => 'system/modules/feuerwehr-manager/models/FwmVehiclesModel.php',
	'Contao\FwmDepartmentsModel'  => 'system/modules/feuerwehr-manager/models/FwmDepartmentsModel.php',
	'Contao\FwmAlertsModel'       => 'system/modules/feuerwehr-manager/models/FwmAlertsModel.php',
	'ModuleAlertMap'              => 'system/modules/feuerwehr-manager/ModuleAlertMap.php',
	'AlertDetails'                => 'system/modules/feuerwehr-manager/AlertDetails.php',
	'ModuleAlertStatisticYears'   => 'system/modules/feuerwehr-manager/ModuleAlertStatisticYears.php',
	'ContentAlertStatistic'       => 'system/modules/feuerwehr-manager/ContentAlertStatistic.php',

	// Modules
	'Contao\ModuleAlertFilter'    => 'system/modules/feuerwehr-manager/modules/ModuleAlertFilter.php',
	'Contao\ModuleLastAlert'      => 'system/modules/feuerwehr-manager/modules/ModuleLastAlert.php',
	'Contao\ModuleAlertList'      => 'system/modules/feuerwehr-manager/modules/ModuleAlertList.php',
	'generateCharts'              => 'system/modules/feuerwehr-manager/generateCharts.php',

	// Widgets
	'Contao\SearchMap'            => 'system/modules/feuerwehr-manager/widgets/SearchMap.php',
	'ModuleAlertStatisticYear'    => 'system/modules/feuerwehr-manager/ModuleAlertStatisticYear.php',
));


/**
 * Register the templates
 */
TemplateLoader::addFiles(array
(
	'mod_fwm_last_alert'       => 'system/modules/feuerwehr-manager/templates',
	'fwm_alertStatisticReader' => 'system/modules/feuerwehr-manager/templates',
	'mod_fwm_alert_filter'     => 'system/modules/feuerwehr-manager/templates',
	'fwm_alertMap'             => 'system/modules/feuerwehr-manager/templates',
	'fwm_alertStatisticYears'  => 'system/modules/feuerwehr-manager/templates',
	'be_alert_statistic_year'  => 'system/modules/feuerwehr-manager/templates',
	'be_alert_statistic_total' => 'system/modules/feuerwehr-manager/templates',
	'ce_alert_statistic'       => 'system/modules/feuerwehr-manager/templates',
	'be_map_widget'            => 'system/modules/feuerwehr-manager/templates',
	'fwm_alertDetailsMap'      => 'system/modules/feuerwehr-manager/templates',
	'mod_fwm_alert_list'       => 'system/modules/feuerwehr-manager/templates',
));
