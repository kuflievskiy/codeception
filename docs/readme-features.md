php vendor/codeception/codeception/codecept g:feature Acceptance checkout
php vendor/codeception/codeception/codecept gherkin:snippets Acceptance checkout.feature
php vendor/codeception/codeception/codecept dry-run Acceptance checkout.feature
php vendor/codeception/codeception/codecept gherkin:steps Acceptance
php vendor/codeception/codeception/codecept run Acceptance ./tests/Acceptance/checkout.feature --html --colors --steps --env firefox