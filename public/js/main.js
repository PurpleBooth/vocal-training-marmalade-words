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
         * Request a new word, and display it
         */
        self.changeText = function () {
            $.get(window.location.href, {}, function (data, textStatus, jqXHR) {
                if(!reminder == 0) {
                    reminderCount++;
                }

                var $body = $(data);
                var text = $body.get(14).nodeValue;

                if(!reminder == 0 && reminderCount == reminder) {
                    text += reminderSymbol;
                    reminderCount = 0;
                }

                $('body').text(text);
            });

        };

        return self;
    }

    window.wordPhraseGeneration = new WordPhraseGeneration();
    wordPhraseGeneration.init();
})(jQuery);

