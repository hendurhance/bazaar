(function($) {
    "use strict";

    const ps1 = new PerfectScrollbar('.header-dropdown-list', {
        useBothWheelAxes: true,
        suppressScrollX: true,
        suppressScrollY: false,
    });
    const ps2 = new PerfectScrollbar('.notifications-menu', {
        useBothWheelAxes: true,
        suppressScrollX: true,
        suppressScrollY: false,
    });
    const ps3 = new PerfectScrollbar('.message-menu-scroll', {
        useBothWheelAxes: true,
        suppressScrollX: true,
        suppressScrollY: false,
    });

    //P-scrolling
})(jQuery);