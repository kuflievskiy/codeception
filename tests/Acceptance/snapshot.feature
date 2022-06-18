@snapshot
Feature: snapshot
  In order to test the static page.
  As a customer.
  I need to open the page by URL and compare it with the preview result.

#  Background:

  Scenario: check snapshots as admin
    Given I set data for test static pages:
      | https://codeception.com/docs/01-Introduction |
      | https://codeception.com/quickstart           |
    Then check static pages