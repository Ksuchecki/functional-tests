
Feature:Check page brand24.pl

  Scenario: Check word at page
    Given Web address is "https://brand24.pl"
    When  Enter this site
    Then  Check text "brand"
