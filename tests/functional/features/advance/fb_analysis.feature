@javascript
Feature:Check page brand24.pl

  Scenario: Check analysis tab- Filter mention by Facebook
    Given Im logged in
    When I click project
    And I click on analysis tab
    And I click on filter mentions
    And Find Facebook field
    And I click on checkbox
    Then I should see mentions from Facebook