Feature: Phrase API
  In order to reduce the number of the phrase API calls
  As a operator of a free service on limited hosting
  I need to have a JSON API

  Scenario: API returns 100 phrases each shot
    Given the following phrases exist:
      | Phrase         |
      | Mad March      |
      | Monday Morning |
    When view the phrases api
    Then the response should be valid json
    And I should see 175 phrases
    And the same phrase should not be repeated twice in sequence