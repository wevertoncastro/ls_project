#features/multiple_args.feature
Feature:
  In order to receive multiple args
  As a table
  I need do a foreach
  
  Scenario: List all rows of table
    Given the following people exist:
      | name  | email           | phone |
      | Aslak | aslak@email.com | 123   |
      | Joe   | jow@email.com   | 234   |
      | Bryan | bryan@email.com | 456   |