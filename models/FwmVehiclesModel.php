<?php

namespace Contao;

class FwmVehiclesModel extends \Model
{

	/**
	 * Table name
	 * @var string
	 */
	protected static $strTable = 'tl_fwm_vehicles';

	public static function getVehiclesByDepartmentIds($ids, array $arrOptions=array())
	{
		$arrOptions['order'] = 'title';

		return static::findBy(array('pid =' . implode(' OR pid = ', $ids)), null, $arrOptions);
	}
}
