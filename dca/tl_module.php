<?php

/**
 * Table tl_module
 */
$GLOBALS['TL_DCA']['tl_module']['palettes']['fwm_alertArchive'] =		   '{title_legend},name,headline,type;
																			{config_legend},fwm_alert_archives;
																			{template_legend:hide},fwm_template;
																			{protected_legend:hide},protected;
																			{expert_legend:hide},guests,cssID,space';

$GLOBALS['TL_DCA']['tl_module']['palettes']['fwm_alertArchiveMenu'] =	   '{title_legend},name,headline,type;
																			{config_legend},fwm_alert_menulinks,fwm_all_link;
																			{redirect_legend},jumpTo;
																			{template_legend:hide},fwm_template;
																			{protected_legend:hide},protected;
																			{expert_legend:hide},guests,cssID,space';

$GLOBALS['TL_DCA']['tl_module']['palettes']['fwm_alertArchiveReader'] =	   '{title_legend},name,headline,type;
																			{template_legend:hide},fwm_template;
																			{protected_legend:hide},protected;
																			{expert_legend:hide},guests,cssID,space';

$GLOBALS['TL_DCA']['tl_module']['palettes']['fwm_alertLast'] =			   '{title_legend},name,headline,type;
																			{template_legend:hide},fwm_template;
																			{protected_legend:hide},protected;
																			{expert_legend:hide},guests,cssID,space';

$GLOBALS['TL_DCA']['tl_module']['palettes']['fwm_alertMap'] =			   '{title_legend},name,headline,type;
																			{template_legend:hide},fwm_template;
																			{protected_legend:hide},protected;
																			{expert_legend:hide},guests,cssID,space';

$GLOBALS['TL_DCA']['tl_module']['palettes']['fwm_alertGalleryViewer'] =	   '{title_legend},name,headline,type;
																			{config_legend},fwm_alert_gallery_thumbs;
																			{redirect_legend},jumpTo;
																			{template_legend:hide},fwm_template;
																			{protected_legend:hide},protected;
																			{expert_legend:hide},guests,cssID,space';

$GLOBALS['TL_DCA']['tl_module']['palettes']['fwm_alertStatisticYears'] =   '{title_legend},name,headline,type;
																			{config_legend},fwm_alert_menulinks,fwm_chartShowTitle,fwm_chartWidth,fwm_chartBg,fwm_chartPositionLegend,fwm_chartColors;
																			{template_legend:hide},fwm_template;
																			{protected_legend:hide},protected;
																			{expert_legend:hide},guests,cssID,space';


$GLOBALS['TL_DCA']['tl_module']['palettes']['fwm_alertStatisticReader'] =  '{title_legend},name,headline,type;
																			{config_legend},fwm_chartShowTitle,fwm_chartWidth,fwm_chartBg,fwm_chartPositionLegend,fwm_chartColors;
																			{template_legend:hide},fwm_template;
																			{protected_legend:hide},protected;
																			{expert_legend:hide},guests,cssID,space';


$GLOBALS['TL_DCA']['tl_module']['fields']['fwm_alert_archives'] = array
	(
	    'label'      		=> &$GLOBALS['TL_LANG']['tl_module']['fwm']['alert_archives'],
	    'inputType'  		=> 'select',
	    'foreignKey' 		=> 'tl_alert_archive.year',
	    'eval'       		=> array('mandatory' => true)
	);

$GLOBALS['TL_DCA']['tl_module']['fields']['fwm_alert_menulinks'] = array
	(
		'label'         	=> &$GLOBALS['TL_LANG']['tl_module']['fwm']['alert_menulinks'],
		'exclude'       	=> true,
		'inputType'     	=> 'select',
		'foreignKey' 		=> 'tl_alert_archive.year',
		'eval'          	=> array('multiple'=>true)
	);


$GLOBALS['TL_DCA']['tl_module']['fields']['fwm_alert_gallery_thumbs'] = array
	(
		'label' 			=> &$GLOBALS['TL_LANG']['tl_module']['fwm']['alert_gallery_thumbs'],
		'exclude' 			=> true,
		'inputType' 		=> 'imageSize',
		'options' 			=> array('crop', 'proportional', 'box'),
		'reference' 		=> &$GLOBALS['TL_LANG']['MSC'],
		'eval' 				=> array('rgxp'				=> 'digit', 
								 	 'nospace'			=> true,
								 	 'helpwizard'		=> true,
								 	 'tl_class'			=> 'clr')
	);

$GLOBALS['TL_DCA']['tl_module']['fields']['fwm_all_link'] = array
	(
		'label'         	=> &$GLOBALS['TL_LANG']['tl_module']['fwm']['all_link'],
		'exclude'       	=> true,
		'inputType'     	=> 'checkbox'
	);

$GLOBALS['TL_DCA']['tl_module']['fields']['fwm_chartBg'] = array
	(
		'label'         	=> &$GLOBALS['TL_LANG']['tl_module']['fwm']['chartBg'],
		'inputType'     	=> 'text',
		'wizard' 			=> array(array('tl_module_alert_statistic', 'colorPicker')),
		'eval'          	=> array('maxlength'		=> 6, 
								 	 'isHexColor'		=> true, 
								 	 'decodeEntities'	=> true, 
								 	 'tl_class'			=> 'w50 wizard')
	);

$GLOBALS['TL_DCA']['tl_module']['fields']['fwm_chartWidth'] = array
	(
		'label'         	=> &$GLOBALS['TL_LANG']['tl_module']['fwm']['chartWidth'],
		'inputType'     	=> 'inputUnit',
		'options'       	=> array('px', '%'),
		'eval'          	=> array('rgxp'				=> 'digit_auto_inherit', 
								 	 'tl_class'			=> 'w50')
	);

$GLOBALS['TL_DCA']['tl_module']['fields']['fwm_chartShowTitle'] = array
	(
		'label'         	=> &$GLOBALS['TL_LANG']['tl_module']['fwm']['chartShowTitle'],
		'inputType'     	=> 'checkbox',
		'eval'				=> array('tl_class' => 'm12')
	);

$GLOBALS['TL_DCA']['tl_module']['fields']['fwm_chartPositionLegend'] = array
	(
		'label' 			=> &$GLOBALS['TL_LANG']['tl_module']['fwm']['chartPositionLegend'],
		'inputType' 		=> 'select',
		'options' 			=> $GLOBALS['TL_LANG']['tl_module']['fwm']['chartPositions'],
		'reference' 		=> &$GLOBALS['TL_LANG']['MSC']
	);

$GLOBALS['TL_DCA']['tl_module']['fields']['fwm_chartColors'] = array
	(
		'label'         	=> &$GLOBALS['TL_LANG']['tl_module']['fwm']['chartColors'],
		'inputType'     	=> 'text',
		'wizard' 			=> array(array('tl_module_alert_statistic', 'colorPicker')),
		'eval'          	=> array('tl_class' => 'wizard')
	);

$GLOBALS['TL_DCA']['tl_module']['fields']['fwm_template'] = array
	(
		'label'         	=> &$GLOBALS['TL_LANG']['tl_module']['fwm']['fwm_template'],
		'default'           => 'fwm_alert_last_alert',
		'exclude'           => true,
		'inputType'         => 'select',
		'options_callback'  => array('tl_module_alert_statistic', 'getFWMTemplates'),
		'eval'              => array('tl_class' => 'w50')
	);



class tl_module_alert_statistic extends Backend{

	/**
	 * Return color picker markup
	 * @param DataContainer
	 * @return string
	 */
	public function colorPicker(DataContainer $dc)
	{	
		/* check if multiple colors can be stored */
		if($dc->field === 'fwm_chartColors'){
			$colorStr = '$("ctrl_' . $dc->field . '").value + color.hex + ","';
		}else{
			$colorStr = 'color.hex';
		}
		
		return ' ' . $this->generateImage('pickcolor.gif', $GLOBALS['TL_LANG']['MSC']['colorpicker'], 'style="vertical-align:top;cursor:pointer" id="moo_'.$dc->field.'"') . '
			  <script>
			  new MooRainbow("moo_'.$dc->field.'", {
			    id:"ctrl_' . $dc->field . '",
			    startColor:((cl = $("ctrl_' . $dc->field . '").value.hexToRgb(true)) ? cl : [255, 0, 0]),
			    imgPath:"plugins/colorpicker/images/",
			    onComplete: function(color) {
			      $("ctrl_' . $dc->field . '").value =' . $colorStr . '
			    }
			  });
			  </script>';
	}
	
	/**
	 * Return custom templates 
	 * @param DataContainer
	 * @return array
	 */
	public function getFWMTemplates(DataContainer $dc)
	{
		$intPid = $dc->activeRecord->pid;

		if ($this->Input->get('act') == 'overrideAll')
		{
			$intPid = $this->Input->get('id');
		}

		return $this->getTemplateGroup($dc->activeRecord->type, $intPid);
	}

}