@javascript
Feature:Check page brand24.pl

  Scenario:Find mentions from facebook
    Given Im logged in
    When I click project
    And I click on Facebook mentions
    Then I see mentions from Facebook
