<?php
namespace Combodo\iTop\Test\UnitTest\Core;

use Combodo\iTop\Test\UnitTest\ItopTestCase;
use Config;
use DateTime;


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
	 * @param \DateTime $oExpected
	 *
	 * @throws \Exception
	 */
	public function TestGetNextOccurrence($bEnabledValue, $sTimeValue, $oExpected)
	{
		$oWeeklyImpl = new \WeeklyScheduledProcessMockConfig($bEnabledValue, $sTimeValue);
		$this->assertEquals($oExpected, $oWeeklyImpl->GetNextOccurrence());
	}

	public function GetNextOccurrenceProvider()
	{
		return array(
			'Disabled process' => array(
				false, null, new DateTime('3000-01-01')
			)
		);
	}
}

