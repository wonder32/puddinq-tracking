import '../scss/puddinq-tracking.scss';
import {keyTracking} from "./modules/keyTracking";

import $ from 'jquery';

$(document).ready(function() {

    $(document).on('keypress', keyTracking);

    if ($('.debug-tracking.active').length > 0) {
        $('.debug-tracking.active').html('test dit');
    }
});
