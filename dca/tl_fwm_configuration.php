<?php

$GLOBALS['TL_DCA']['tl_fwm_configuration'] = array
(
	'config' => array
	(
		'dataContainer'               => 'File'
	),

	'palettes' => array
	(
		'default'                     => '{department_legend},fwmMainDepartment;{keys_legend},fwmAlertKeys;{maps_legend},googleMapsApiKey'
	),
	'fields' => array
	(
		'fwmMainDepartment' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_fwm_configuration']['mainDepartment'],
			'exclude'                 => true,
			'inputType'               => 'select',
			'foreignKey'							=> 'tl_fwm_departments.title',
			'eval'                    => array('tl_class'=>'w50')
		),
		'fwmAlertKeys' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_fwm_configuration']['alertKeys'],
			'exclude'                 => true,
			'inputType'               => 'listWizard'
		),
		'googleMapsApiKey' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_fwm_configuration']['googleMapsApiKey'],
			'exclude'                 => true,
			'inputType'               => 'text',
			'eval'                    => array('tl_class'=>'w50')
		),
	)
);
