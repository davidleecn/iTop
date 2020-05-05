<?php

/**
 * Tool class to mock the config in {@link AbstractWeeklyScheduledProcess}
 *
 * @package Combodo\iTop\Test\UnitTest\Core
 */
class WeeklyScheduledProcessMockConfig extends AbstractWeeklyScheduledProcess
{
	const MODULE_NAME = 'TEST_SCHEDULED_PROCESS';

	public function __construct($bEnabledValue, $sTimeValue)
	{
		$this->oConfig = new Config();
		$this->oConfig->SetModuleSetting(self::MODULE_NAME, self::MODULE_SETTING_ENABLED, $bEnabledValue);
		$this->oConfig->SetModuleSetting(self::MODULE_NAME, self::MODULE_SETTING_TIME, $sTimeValue);
	}

	protected function GetModuleName()
	{
		return self::MODULE_NAME;
	}

	protected function GetDefaultModuleSettingTime()
	{
		return null; // config mock injected in the constructor
	}

	public function Process($iUnixTimeLimit)
	{
		// nothing to do here (not tested)
	}
}