<?php

/**
 * Table tl_content
 */
$GLOBALS['TL_DCA']['tl_content']['palettes']['alert_statistic']  = '{type_legend},type,headline;
																	{statistic_legend},fwm_statisticType,fwm_statisticYear;
																	{config_legend},fwm_chartShowTitle,fwm_chartWidth,fwm_chartBg,fwm_chartPositionLegend,fwm_chartColors;
																	{protected_legend:hide},protected;
																	{expert_legend:hide},guests,invisible,cssID,space';

$GLOBALS['TL_DCA']['tl_content']['fields']['fwm_statisticType'] = array
	(
	    'label'            => &$GLOBALS['TL_LANG']['tl_content']['fwm']['statisticType'],
	    'inputType'        => 'select',
	    'options_callback' => array('DataContainerStatistic','statisticTypes'),
	    'explanation'	   => 'statisticTypeExplain',
	    'eval'             => array('mandatory'          => true,
	                                'submitOnChange' 	 => true,
	                                'helpwizard'		 => true,
	                                'tl_class'			 => 'w50'
	                                )
	);

$GLOBALS['TL_DCA']['tl_content']['fields']['fwm_statisticYear'] = array
	(
	    'label'            => &$GLOBALS['TL_LANG']['tl_content']['fwm']['statisticYear'],
	    'inputType'        => 'select',
	    'options_callback' => array('DataContainerStatistic', 'getStatisticYears'),
	    'load_callback'    => array(array('DataContainerStatistic', 'toggleMultiple')),
	    'eval'             => array('mandatory'          => true,
	                                'tl_class'			 => 'w50',
	                                'multiple'			 => false)
	);

$GLOBALS['TL_DCA']['tl_content']['fields']['fwm_chartBg'] = array
	(
		'label'            => &$GLOBALS['TL_LANG']['tl_content']['fwm']['chartBg'],
		'inputType'        => 'text',
		'wizard' 		   => array(array('tl_alert_statistic', 'colorPicker')),
		'eval'             => array('maxlength'			=> 6, 
									'isHexColor'		=> true, 
									'decodeEntities'	=> true, 
									'tl_class'			=> 'w50 wizard')
	);

$GLOBALS['TL_DCA']['tl_content']['fields']['fwm_chartWidth'] = array
	(
		'label'           => &$GLOBALS['TL_LANG']['tl_content']['fwm']['chartWidth'],
		'inputType'       => 'inputUnit',
		'options'         => array('px', '%'),
		'eval'            => array('rgxp'				=> 'digit_auto_inherit', 
								   'tl_class'			=> 'w50')
	);

$GLOBALS['TL_DCA']['tl_content']['fields']['fwm_chartShowTitle'] = array
	(
		'label'           => &$GLOBALS['TL_LANG']['tl_content']['fwm']['chartShowTitle'],
		'inputType'       => 'checkbox',
		'eval'			  => array('tl_class' => 'm12')
	);

$GLOBALS['TL_DCA']['tl_content']['fields']['fwm_chartPositionLegend'] = array
	(
		'label' 		  => &$GLOBALS['TL_LANG']['tl_content']['fwm']['chartPositionLegend'],
		'inputType' 	  => 'select',
		'options' 		  => $GLOBALS['TL_LANG']['tl_content']['fwm']['chartPositions'],
		'reference' 	  => &$GLOBALS['TL_LANG']['MSC']
	);

$GLOBALS['TL_DCA']['tl_content']['fields']['fwm_chartColors'] = array
	(
		'label'           => &$GLOBALS['TL_LANG']['tl_content']['fwm']['chartColors'],
		'inputType'       => 'text',
		'wizard' 		  => array(array('tl_alert_statistic', 'colorPicker')),
		'eval'            => array('tl_class' => 'wizard')
	);


class tl_alert_statistic extends Backend{

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

}