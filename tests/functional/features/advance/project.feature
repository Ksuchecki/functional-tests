@javascript
Feature:Check page brand24.pl

  Scenario:Edit project-change project name
    Given Im logged in
    When I click project
    And Change project name at "testBrand"
    And Click save
    Then I am in my project
