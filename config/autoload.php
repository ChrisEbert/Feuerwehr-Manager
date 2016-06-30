<?php

/**
 * Contao Open Source CMS
 *
 * Copyright (c) 2005-2014 Leo Feyer
 *
 * @package Feuerwehr_manager
 * @link    https://contao.org
 * @license http://www.gnu.org/licenses/lgpl-3.0.html LGPL
 */


/**
 * Register the classes
 */
ClassLoader::addClasses(array
(
	'BeModuleAlertStatisticTotal' => 'system/modules/feuerwehr_manager/BeModuleAlertStatisticTotal.php',
	'BeModuleAlertStatisticYear'  => 'system/modules/feuerwehr_manager/BeModuleAlertStatisticYear.php',
	'ContentAlertStatistic'       => 'system/modules/feuerwehr_manager/ContentAlertStatistic.php',
	'DataContainerStatistic'      => 'system/modules/feuerwehr_manager/DataContainerStatistic.php',
	'generateCharts'              => 'system/modules/feuerwehr_manager/generateCharts.php',
	'ModuleAlertArchive'          => 'system/modules/feuerwehr_manager/ModuleAlertArchive.php',
	'ModuleAlertArchiveMenu'      => 'system/modules/feuerwehr_manager/ModuleAlertArchiveMenu.php',
	'ModuleAlertArchiveReader'    => 'system/modules/feuerwehr_manager/ModuleAlertArchiveReader.php',
	'ModuleAlertGalleryMenu'      => 'system/modules/feuerwehr_manager/ModuleAlertGalleryMenu.php',
	'ModuleAlertGalleryViewer'    => 'system/modules/feuerwehr_manager/ModuleAlertGalleryViewer.php',
	'ModuleAlertLastAlert'        => 'system/modules/feuerwehr_manager/ModuleAlertLastAlert.php',
	'ModuleAlertStatisticReader'  => 'system/modules/feuerwehr_manager/ModuleAlertStatisticReader.php',
	'ModuleAlertStatisticTotal'   => 'system/modules/feuerwehr_manager/ModuleAlertStatisticTotal.php',
	'ModuleAlertStatisticYear'    => 'system/modules/feuerwehr_manager/ModuleAlertStatisticYear.php',
	'ModuleAlertStatisticYears'   => 'system/modules/feuerwehr_manager/ModuleAlertStatisticYears.php',
	'SearchMap'                   => 'system/modules/feuerwehr_manager/SearchMap.php',
	'ModuleAlertMap'              => 'system/modules/feuerwehr_manager/ModuleAlertMap.php',
	'AlertDetails'                => 'system/modules/feuerwehr_manager/AlertDetails.php',
));


/**
 * Register the templates
 */
TemplateLoader::addFiles(array
(
	'be_alert_statistic_total' => 'system/modules/feuerwehr_manager/templates',
	'be_alert_statistic_year'  => 'system/modules/feuerwehr_manager/templates',
	'ce_alert_statistic'       => 'system/modules/feuerwehr_manager/templates',
	'fwm_alertArchive'         => 'system/modules/feuerwehr_manager/templates',
	'fwm_alertArchiveMenu'     => 'system/modules/feuerwehr_manager/templates',
	'fwm_alertArchiveReader'   => 'system/modules/feuerwehr_manager/templates',
	'fwm_alertGalleryViewer'   => 'system/modules/feuerwehr_manager/templates',
	'fwm_alertLast'            => 'system/modules/feuerwehr_manager/templates',
	'fwm_alertStatisticReader' => 'system/modules/feuerwehr_manager/templates',
	'fwm_alertStatisticYears'  => 'system/modules/feuerwehr_manager/templates',
	'be_map_widget'            => 'system/modules/feuerwehr_manager/templates',
	'fwm_alertMap'             => 'system/modules/feuerwehr_manager/templates',
	'fwm_alertDetailsMap'      => 'system/modules/feuerwehr_manager/templates',
));
