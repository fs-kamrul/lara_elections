'use strict';

$(document).ready(function () {
    $(document).on('click', '.add-courses-intended-schema-items', function (event) {
        event.preventDefault();

        $('.courses-intended-schema-items').toggleClass('hidden');
    });
});
