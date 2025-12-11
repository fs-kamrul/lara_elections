document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.input-group.datepicker').forEach(function (group) {
        const input = group.querySelector('input');
        const toggle = group.querySelector('[data-toggle="datepicker"]');
        const clear = group.querySelector('[data-clear="datepicker"]');

        // Initialize flatpickr if available
        if (window.flatpickr) {
            const picker = flatpickr(input, {
                dateFormat: input.getAttribute('data-date-format') || 'Y-m-d',
                allowInput: true,
                static: true,
            });

            toggle?.addEventListener('click', () => picker.open());
            clear?.addEventListener('click', () => picker.clear());
        } else {
            console.warn('Flatpickr not loaded');
        }
    });
});
