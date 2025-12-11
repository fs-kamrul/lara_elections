/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!********************************************!*\
  !*** ./Resources/assets/js/date-picker.js ***!
  \********************************************/
document.addEventListener('DOMContentLoaded', function () {
  document.querySelectorAll('.input-group.datepicker').forEach(function (group) {
    var input = group.querySelector('input');
    var toggle = group.querySelector('[data-toggle="datepicker"]');
    var clear = group.querySelector('[data-clear="datepicker"]');

    // Initialize flatpickr if available
    if (window.flatpickr) {
      var picker = flatpickr(input, {
        dateFormat: input.getAttribute('data-date-format') || 'Y-m-d',
        allowInput: true,
        "static": true
      });
      toggle === null || toggle === void 0 ? void 0 : toggle.addEventListener('click', function () {
        return picker.open();
      });
      clear === null || clear === void 0 ? void 0 : clear.addEventListener('click', function () {
        return picker.clear();
      });
    } else {
      console.warn('Flatpickr not loaded');
    }
  });
});
/******/ })()
;