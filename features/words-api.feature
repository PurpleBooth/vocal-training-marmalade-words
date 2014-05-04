Feature: Words API
  In order to reduce the number of the word API calls
  As a operator of a free service on limited hosting
  I need to have a json API

  Scenario: API returns 100 phrases each shot
    Given the following words exist:
      | Word      |
      | March     |
      | Marmalade |
    When view the words api
    Then the response should be valid json
    And I should see 100 words
    And the same word should not be repeated twice in sequence