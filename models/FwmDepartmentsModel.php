<?php

namespace Contao;

class FwmDepartmentsModel extends \Model
{

	/**
	 * Table name
	 * @var string
	 */
	protected static $strTable = 'tl_fwm_departments';

	public static function getDepartmentById($id)
	{
		return static::findByPk($id);
	}
}
