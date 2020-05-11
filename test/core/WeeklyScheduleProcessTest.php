<?php
namespace Combodo\iTop\Test\UnitTest\Core;

use Combodo\iTop\Test\UnitTest\ItopTestCase;
use Config;
use DateTime;


/**
 * @runTestsInSeparateProcesses
 * @preserveGlobalState disabled
 * @backupGlobals disabled
 *
 * @package Combodo\iTop\Test\UnitTest\Core
 */
class TestWeeklyScheduledProcess extends ItopTestCase
{
	protected function setUp()
	{
		parent::setUp();
		require_once(APPROOT.'core/backgroundprocess.inc.php');
		require_once(APPROOT.'test/core/WeeklyScheduledProcessMockConfig.php');
	}


	/**
	 * @dataProvider GetNextOccurrenceProvider
	 * @test
	 *
	 * @param boolean $bEnabledValue
	 * @param string $sTimeValue
	 * @param $oExpectedTimeStamp
	 *
	 * @throws \Exception
	 */
	public function TestGetNextOccurrence($bEnabledValue, $sTimeValue, $oExpectedTimeStamp)
	{
		$oWeeklyImpl = new \WeeklyScheduledProcessMockConfig($bEnabledValue, $sTimeValue);

		$sItopTimeZone = $oWeeklyImpl->getOConfig()->Get('timezone');
		$timezone = new \DateTimeZone($sItopTimeZone);
		$oExpectedDateTime = new DateTime($oExpectedTimeStamp, $timezone);

		$this->assertEquals($oExpectedDateTime, $oWeeklyImpl->GetNextOccurrence());
	}

	public function GetNextOccurrenceProvider()
	{
		return array(
			'Disabled process' => array(
				false, null, '3000-01-01'
			)
		);
	}
}

