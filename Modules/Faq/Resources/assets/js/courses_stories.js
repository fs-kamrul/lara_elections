'use strict';

$(document).ready(function () {
    $(document).on('click', '.add-courses-stories-schema-items', function (event) {
        event.preventDefault();

        $('.courses-stories-schema-items').toggleClass('hidden');
    });
});
