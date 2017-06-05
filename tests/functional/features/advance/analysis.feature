@javascript
Feature:Check page brand24.pl

  Scenario: Check analysis tab- Filter mention
    Given Im logged in
    When I click project
    And I click on analysis tab
    And I click on filter mentions
    And Find and fill field
    And I click search button
    Then I should see mentions with our phrese

