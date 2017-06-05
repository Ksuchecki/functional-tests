@javascript
Feature:Check page brand24.pl

  Scenario: We test the search engine in Brand24
    Given Im logged in
    When I click project
    And Find and fill search field
    Then I should see mentions with our phrese
