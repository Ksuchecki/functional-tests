Feature:Check page brand24.pl

  Scenario:Sign in to brand24.pl
    Given Web address is "https://brand24.pl/user/login/?backurl=%2Fpanel%2Fresults%2F%3Fsid%3D7547124#d1=2016-12-17&d2=2017-01-16&va=1&dr=4&cdt=days&or=0&p=1"
    When  Enter this web address
    And I find login field
    And I find password field
    And I use "alebardzoprosze@brand24.pl" as login and "qwe123" as password
    And I find the login button
    And I press the login  button
    Then I am logged in
