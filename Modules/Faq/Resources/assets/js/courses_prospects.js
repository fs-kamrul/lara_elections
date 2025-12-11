'use strict';

$(document).ready(function () {
    $(document).on('click', '.add-courses-prospects-schema-items', function (event) {
        event.preventDefault();

        $('.courses-prospects-schema-items').toggleClass('hidden');
    });
});
