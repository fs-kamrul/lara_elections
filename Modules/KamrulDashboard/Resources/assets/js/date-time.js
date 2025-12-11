document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.input-group.datetimepicker').forEach(function (group) {
        const input  = group.querySelector('input');
        const toggle = group.querySelector('[data-toggle="datetimepicker"]');
        const clear  = group.querySelector('[data-clear="datetimepicker"]');

        if (window.flatpickr) {
            const picker = flatpickr(input, {
                enableTime: true,
                dateFormat: input.getAttribute('data-date-format') || 'Y-m-d H:i',
                time_24hr: true,
                allowInput: true,
                static: true,
            });

            toggle?.addEventListener('click', () => picker.open());
            clear?.addEventListener('click', () => picker.clear());
        } else {
            console.warn('Flatpickr not found.');
        }
    });
});
