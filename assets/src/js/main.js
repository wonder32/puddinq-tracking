import '../scss/puddinq-tracking.scss';

import $ from 'jquery';

$(document).ready(function() {

    if ($('.debug-tracking.active').length > 0) {
        $('.debug-tracking.active').html('test dit');
    }
});
