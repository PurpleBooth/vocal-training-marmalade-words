<?php

use Behat\Behat\Event\ScenarioEvent;
use Behat\Gherkin\Node\TableNode;
use Behat\Mink\Exception\ExpectationException;
use Behat\MinkExtension\Context\MinkContext;

//
// Require 3rd-party libraries here:
//
require_once __DIR__.'/../../vendor/phpunit/phpunit/src/Framework/Assert/Functions.php';

/**
 * Features context.
 */
class FeatureContext extends MinkContext
{
    /**
     * @Given /^the following phrases exist:$/
     */
    public function theFollowingPhrasesExist(TableNode $table)
    {
        $this->theFollowingDataExists($table, __DIR__.'/../../data/phrases');
    }

    /**
     * @Given /^the following words? exist:$/
     */
    public function theFollowingWordsExist(TableNode $table)
    {
        $this->theFollowingDataExists($table, __DIR__.'/../../data/words');
    }

    /**
     * @AfterScenario
     */
    public function restoreOriginalPhrases(ScenarioEvent $event)
    {
        $paths = [__DIR__.'/../../data/words', __DIR__.'/../../data/phrases'];
        foreach ($paths as $path) {
            if (file_exists($path.'.orig') && file_exists($path)) {
                unlink($path);
                rename($path.'.orig', $path);
            }
        }
    }

    /**
     * @When /^view the phrases page$/
     */
    public function viewThePhrasesPage()
    {
        $this->visit('/phrases');
    }

    /**
     * @When /^view the phrases api$/
     */
    public function viewThePhrasesApi()
    {
        $this->visit('/phrases.json');
    }

    /**
     * @When /^view the word page$/
     */
    public function viewTheWordPage()
    {
        $this->visit('/words');
    }

    /**
     * @When /^view the words api$/
     */
    public function viewTheWordsApi()
    {
        $this->visit('/words.json');
    }

    /**
     * @Then /^I should see "([^"]*)" or "([^"]*)"$/
     *
     * @param mixed $text1
     * @param mixed $text2
     */
    public function iShouldSeeOr($text1, $text2)
    {
        try {
            $this->assertPageContainsText($text1);
        } catch (ExpectationException $e) {
            try {
                $this->assertPageContainsText($text2);
            } catch (ExpectationException $e) {
                throw new ExpectationException(
                    sprintf('Could not find "%s" or "%s" in page', $text1, $text2),
                    $this->getSession(),
                    $e
                );
            }
        }
    }

    /**
     * @Then /^the response should be valid json$/
     */
    public function assertResponseJson()
    {
        $this->getJsonPage();
        assertEquals(JSON_ERROR_NONE, json_last_error());
    }

    /**
     * @Then /^I should see (\d+) (?:phrase|word)s?$/
     *
     * @param mixed $phraseCount
     */
    public function iShouldSeePhrases($phraseCount)
    {
        $actual = $this->getJsonPage();
        assertCount((int) $phraseCount, $actual);
    }

    /**
     * @Then /^the same (?:phrase|word) should not be repeated twice in sequence$/
     */
    public function theSamePhraseShouldNotBeRepeatedTwiceInSequence()
    {
        $subject = $this->getJsonPage();

        if (!is_array($subject)) {
            throw new \Exception('API did not return array');
        }

        $previousWord = null;

        foreach ($subject as $word) {
            if ($previousWord == $word) {
                throw new \Exception('API returned two consecutive words');
            }

            $previousWord = $word;
        }
    }

    /**
     * @param TableNode $table
     * @param string    $path
     */
    private function theFollowingDataExists(TableNode $table, $path)
    {
        $rows = $table->getRows();
        $words = array_map(
            function ($value) {
                return $value[0];
            },
            $rows
        );

        array_shift($words); // Remove heading
        $formattedWordList = implode("\n", $words);

        rename($path, $path.'.orig');
        file_put_contents($path, $formattedWordList);
    }

    /**
     * @return mixed
     */
    private function getJsonPage()
    {
        $body = $this->getSession()->getPage()->getContent();
        $actual = json_decode($body);

        return $actual;
    }
}
