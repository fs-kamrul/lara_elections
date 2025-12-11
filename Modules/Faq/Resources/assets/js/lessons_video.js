'use strict';

$(document).ready(function () {
    $(document).on('click', '.add-lessons-video-schema-items', function (event) {
        event.preventDefault();

        $('.lessons-video-schema-items').toggleClass('hidden');
    });
});
