Feature: All basic links must work properly

  Scenario: Home link
    Given I am on "api/v1/jobs"
    When I follow "Create new job"
    Then I should see "Create Job Form"