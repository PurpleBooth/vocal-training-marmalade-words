<?php

use Behat\Behat\Event\ScenarioEvent;
use Behat\Gherkin\Node\TableNode;
use Behat\Mink\Exception\ExpectationException;
use Behat\MinkExtension\Context\MinkContext;

//
// Require 3rd-party libraries here:
//
//   require_once 'PHPUnit/Autoload.php';
//   require_once 'PHPUnit/Framework/Assert/Functions.php';
//

/**
 * Features context.
 */
class FeatureContext extends MinkContext
{
    /**
     * Initializes context.
     * Every scenario gets it's own context object.
     *
     * @param array $parameters context parameters (set them up through behat.yml)
     */
    public function __construct(array $parameters)
    {
        // Initialize your context here
    }

    /**
     * @Given /^the following phrases exist:$/
     */
    public function theFollowingPhrasesExist(TableNode $table)
    {
        $this->theFollowingDataExists($table, __DIR__ . "/../../data/phrases");
    }

    private function theFollowingDataExists(TableNode $table, $path)
    {
        $rows = $table->getRows();
        $words = array_map(function ($value) {
            return $value[0];
        }, $rows);

        array_shift($words); // Remove heading
        $formattedWordList = implode("\n", $words);

        rename($path, "$path.orig");
        file_put_contents($path, $formattedWordList);
    }

    /**
     * @AfterScenario
     */
    public function restoreOriginalPhrases(ScenarioEvent $event)
    {
        $paths = array(__DIR__ . "/../../data/words", __DIR__ . "/../../data/phrases");
        foreach ($paths as $path) {
            if (file_exists("$path.orig") && file_exists($path)) {
                unlink($path);
                rename("$path.orig", $path);
            }
        }
    }

    /**
     * @When /^view the phrases page$/
     */
    public function viewThePhrasesPage()
    {
        $this->visit("/phrases");
    }

    /**
     * @Then /^I should see "([^"]*)" or "([^"]*)"$/
     */
    public function iShouldSeeOr($text1, $text2)
    {
        try {
            $this->assertPageContainsText($text1);
        } catch (ExpectationException $e) {
            try {
                $this->assertPageContainsText($text2);
            } catch (ExpectationException $e) {
                throw new ExpectationException("Could not find \"$text1\" or \"$text2\" in page", $this->getSession(), $e);
            }
        }
    }

    /**
     * @When /^view the word page$/
     */
    public function viewTheWordPage()
    {
        $this->visit("/words");
    }

    /**
     * @Given /^the following words? exist:$/
     */
    public function theFollowingWordsExist(TableNode $table)
    {
        $this->theFollowingDataExists($table, __DIR__ . "/../../data/words");
    }

}
