(function ($) {
    "use strict";

    /**
     *
     * @returns {{}}
     * @constructor
     */
    function WordPhraseGeneration() {
        /**
         * This
         * @type {{}}
         */
        var self = {};

        /**
         * What to append after the word as a reminder
         * @type {string}
         */
        var reminderSymbol = ' *';

        /**
         * The word number to display the reminder on
         *
         * @type {number}
         */
        var reminder;

        /**
         * Which word we're on.
         *
         * 1 for the first word (remember we pre-load the first word)
         *
         * @type {number}
         */
        var reminderCount = 1;

        /**
         * Time in MS to request a new word at
         *
         * @type {number}
         */
        var changeInterval;

        /**
         * Words currently loaded from API. When .length == 0 more will be requested
         *
         * @type {Array}
         */
        var loadedWords = [];

        /**
         * Bind the change event
         * Read the reminder & interval settings
         */
        self.init = function () {
            reminder = $('body').data('reminder');
            changeInterval = $('body').data('interval');

            self.setChangeInterval();
        };

        /**
         * Set interval to request new words at
         */
        self.setChangeInterval = function () {
            setInterval(self.changeText, changeInterval);
        };

        /**
         * Request a new word, from API or cache, and display it
         */
        self.changeText = function () {
            if (loadedWords.length == 0) {
                $.get(window.location.href + ".json", {}, function (data, textStatus, jqXHR) {
                    loadedWords = data;
                    self.displayNewWord(loadedWords.pop());
                });
            }
            else {
                self.displayNewWord(loadedWords.pop());
            }
        };

        /**
         * Display a word on the page
         *
         * @param {string} word
         */
        self.displayNewWord = function (word) {
            if (!reminder == 0) {
                reminderCount++;
            }

            if (!reminder == 0 && reminderCount == reminder) {
                word += reminderSymbol;
                reminderCount = 0;
            }

            $('body').text(word.toUpperCase());
        };

        return self;
    }

    window.wordPhraseGeneration = new WordPhraseGeneration();
    wordPhraseGeneration.init();
})(jQuery);

