(function() {
    
    var Base = {};

    Base.whichTransitionEvent = function() {

        var t, el = document.createElement("fakeelement");

        var transitions = {
            "transition"      : "transitionend",
            "OTransition"     : "oTransitionEnd",
            "MozTransition"   : "transitionend",
            "WebkitTransition": "webkitTransitionEnd"
        }

        for (t in transitions) {
            if (el.style[t] !== undefined) {
                return transitions[t];
            }
        }
    };

    $(document).ready(function() {

        var $menu_toggle = $('.mobile_menu'), $header = $('header'), $close_menu = $('.close_menu'), transitionEvent = Base.whichTransitionEvent();

        // clicking on the mobile menu icon will open and close the top menu
        $menu_toggle.add($close_menu).on('click', function() {
            $header.toggleClass('open');
            if($header.hasClass('open')) {
                $('body').toggleClass('open');
            }
        });

        // hiding the scroll bar when mobile menu is open
        $header.on(transitionEvent, function() {
            if(!$header.hasClass('open')) {
                $('body').toggleClass('open');
            }
        });

    });

})();