Feature: Phrases
  In order to help practice random words
  As a student practicing marmalade words
  I need to see a series of words

  Scenario: Words are randomly selected and displayed
    Given the following word exist:
      | Word  |
      | March |
    When view the word page
    Then I should see "March"

  Scenario: Words are randomly selected and displayed
    Given the following words exist:
      | Word      |
      | Mellow    |
      | Marmalade |
    When view the word page
    Then I should see "Mellow" or "Marmalade"