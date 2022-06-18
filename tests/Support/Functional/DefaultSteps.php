<?php

declare(strict_types=1);

namespace Tests\Support\Functional;

use Tests\Support\FunctionalTester;

class DefaultSteps
{

	protected FunctionalTester $I;

	public function __construct(FunctionalTester $I)
	{
		$this->I = $I;
	}

	/**
	 * @Given I open website page :arg1
	 */
	public function iOpenWebsitePage($url)
	{
		// send GET request
		codecept_debug($url);
		$this->I->sendGet($url);
		$this->I->seeResponseCodeIs(200);
	}

	/**
	 * @Then I check if HTTP response code is :arg1
	 */
	public function iCheckIfHTTPResponseCodeIs($code)
	{

		$this->I->seeResponseCodeIs(200);
	}
}
