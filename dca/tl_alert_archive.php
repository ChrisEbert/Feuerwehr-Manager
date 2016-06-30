<?php 

/**
 * Table tl_alert_archive
 */
$GLOBALS['TL_DCA']['tl_alert_archive'] = array
(

	// Config
	'config' => array
	(
		'dataContainer'               => 'Table',
		'ctable'                      => array('tl_alert'),
		'switchToEdit'                => true,
		'enableVersioning'            => true,
	),

	// List
	'list' => array
	(
		'sorting' => array
		(
			'mode'                    => 0,
			'fields'                  => array('year'),
			'flag'                    => 12,
			'panelLayout'             => 'filter;search,limit',
		),
		'label' => array
		(
			'fields'                  => array('year'),
			'format'                  => '%s'
		),
		'global_operations' => array
		(
			'statisticTotal' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_alert_archive']['statisticTotal'],
				'href'                => 'key=statisticTotal',
				'class'               => 'header_fwm_statisticTotal'
			),
			'all' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['MSC']['all'],
				'href'                => 'act=select',
				'class'               => 'header_edit_all',
				'attributes'          => 'onclick="Backend.getScrollOffset()" accesskey="e"'
			)
			
		),
		'operations' => array
		(
			'edit' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_alert_archive']['edit'],
				'href'                => 'table=tl_alert',
				'icon'                => 'edit.gif',
				'attributes'          => 'class="contextmenu"'
			),
			'editheader' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_alert_archive']['editheader'],
				'href'                => 'act=edit',
				'icon'                => 'header.gif',
				'attributes'          => 'class="edit-header"'
			),
			'copy' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_alert_archive']['copy'],
				'href'                => 'act=copy',
				'icon'                => 'copy.gif',
			),
			'delete' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_alert_archive']['delete'],
				'href'                => 'act=delete',
				'icon'                => 'delete.gif',
				'attributes'          => 'onclick="if(!confirm(\'' . $GLOBALS['TL_LANG']['MSC']['deleteConfirm'] . '\'))return false;Backend.getScrollOffset()"',
			),
			'show' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_alert_archive']['show'],
				'href'                => 'act=show',
				'icon'                => 'show.gif'
			),
			'statisticYear' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_alert_archive']['statisticYear'],
				'href'                => 'key=statisticYear',
				'icon'                => 'system/modules/feuerwehr_manager/assets/images/chart.png'
			)
		)
	),

	// Palettes
	'palettes' => array
	(
		'default'                     => '{title_legend},year,galleryPage;{publish_legend:hide},published,start,stop'
	),

	// Fields
	'fields' => array
	(
		'year' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_alert_archive']['year'],
			'exclude'                 => true,
			'search'                  => true,
			'inputType'               => 'text',
			'eval'                    => array('mandatory'=>true, 'maxlength'=>4, 'rgxp'=>'digit')
		),
		'galleryPage' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_alert_archive']['galleryPage'],
			'exclude'                 => true,
			'inputType'               => 'pageTree',
			'eval'                    => array('fieldType'=>'radio')
		),
		'published' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_alert_archive']['published'],
			'exclude'                 => true,
			'filter'                  => true,
			'flag'                    => 1,
			'inputType'               => 'checkbox',
			'eval'                    => array('doNotCopy'=>true)
		),
		'start' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_alert_archive']['start'],
			'exclude'                 => true,
			'inputType'               => 'text',
			'eval'                    => array('rgxp'=>'datim', 'datepicker'=>true, 'tl_class'=>'w50 wizard')
		),
		'stop' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_alert_archive']['stop'],
			'exclude'                 => true,
			'inputType'               => 'text',
			'eval'                    => array('rgxp'=>'datim', 'datepicker'=>true, 'tl_class'=>'w50 wizard')
		)
	)
);