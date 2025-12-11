'use strict';

$(document).ready(function () {
    $(document).on('click', '.add-courses-requirements-schema-items', function (event) {
        event.preventDefault();

        $('.courses-requirements-schema-items').toggleClass('hidden');
    });
});
