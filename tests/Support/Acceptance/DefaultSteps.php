<?php

declare(strict_types=1);

namespace Tests\Support\Acceptance;

use Tests\Support\AcceptanceTester;

class DefaultSteps
{

	protected AcceptanceTester $I;

	/**
	 * __construct
	 */
	public function __construct(AcceptanceTester $I) {
		$this->I = $I;
	}
}
