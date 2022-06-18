@snapshot
Feature: api
  In order to test the API endpoints.
  As a user.
  I need to send requests and test endpoints.

#  Background:

  Scenario: check snapshots as admin
    Given I open website page "https://codeception.com/docs/01-Introduction"
    And I check if HTTP response code is "200"
    Then I open website page "https://codeception.com/quickstart"
    And I check if HTTP response code is "200"