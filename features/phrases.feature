Feature: Phrase
  In order to help practice random phrases
  As a student practicing marmalade words
  I need to see a series of phrases

  Scenario: Words are randomly selected and displayed
    Given the following phrases exist:
      | Phrase    |
      | Mad March |
    When view the phrases page
    Then I should see "Mad March"

  Scenario: Words are randomly selected and displayed
    Given the following phrases exist:
      | Phrase                    |
      | Mellow Molly              |
      | Mum's Marvelous Marmalade |
    When view the phrases page
    Then I should see "Mellow Molly" or "Mum's Marvelous Marmalade"