(function ($) {
    "use strict";

    function WordPhraseGeneration() {

        self.init = function () {
            self.setChangeInterval();
        };

        self.setChangeInterval = function () {
            setInterval(self.changeText, $('body').data('interval'));
        };

        self.changeText = function () {
            $.get(window.location.href, {}, function (data, textStatus, jqXHR) {
                var $body = $(data);
                var text = $body.get(14).nodeValue;

                $('body').text(text);
            });

        };

        return self;
    }

    window.wordPhraseGeneration = new WordPhraseGeneration();
    wordPhraseGeneration.init();
})(jQuery);

