Feature:Check login form at brand24.pl

  Scenario Outline: Check form without login and password
    Given Web address is "https://brand24.pl/konto/logowanie/"
    When  Enter this web address
    And I find login field
    And I find password field
    And  I fill <login> and <password>
    And I find the login button
    And I press the login  button
    Then Check if we are logged
    Examples:
      | login                        | password |
      |                              |          |
      | xxx                          |          |
      |                              |   qwe123 |
      | xxx                          |xxx       |
      | alebardzoprosze@brand24.pl   |xxx       |


