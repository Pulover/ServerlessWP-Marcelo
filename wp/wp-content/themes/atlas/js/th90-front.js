(function($, elementor) {
    "use strict";

    var TH90 = {
        init: function() {
            var widgets = {
                's-postsslider.default': TH90.PostSlick,
                's-postssmallslider.default': TH90.PostSlick,
                's-sliderthumb.default': TH90.PostSlick,
                's-sliderthumb2.default': TH90.PostSlick,
                'w-quotes.default': TH90.PostSlick,
                's-ticker.default': TH90.Ticker,
            };
            $.each(widgets, function(widget, callback) {
                elementor.hooks.addAction('frontend/element_ready/' + widget, callback);
            });
        },

        /* ----------------------------------------------------------- */
        /*  Post block slick slider
        /* ----------------------------------------------------------- */
        PostSlick: function($scope) {
            var $container = $scope.find('.th90-slider');

            if ($($container)[0]) {
                $($container).each(function(index, element) {
                    TH90_SCRIPTS.sliderSlick($(this));
                });
            }
        },

        /* ----------------------------------------------------------- */
        /*  Ticker
        /* ----------------------------------------------------------- */
        Ticker: function($scope) {
            var $container = $scope.find('.block-newsticker');

            if ($($container)[0]) {
                $($container).each(function(index, element) {
                    TH90_SCRIPTS.ticker($(this));
                });
            }
        },
    };
    $(window).on('elementor/frontend/init', TH90.init);
}(jQuery, window.elementorFrontend));
