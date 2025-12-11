/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!******************************************!*\
  !*** ./Resources/assets/js/date-time.js ***!
  \******************************************/
document.addEventListener('DOMContentLoaded', function () {
  document.querySelectorAll('.input-group.datetimepicker').forEach(function (group) {
    var input = group.querySelector('input');
    var toggle = group.querySelector('[data-toggle="datetimepicker"]');
    var clear = group.querySelector('[data-clear="datetimepicker"]');
    if (window.flatpickr) {
      var picker = flatpickr(input, {
        enableTime: true,
        dateFormat: input.getAttribute('data-date-format') || 'Y-m-d H:i',
        time_24hr: true,
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
      console.warn('Flatpickr not found.');
    }
  });
});
/******/ })()
;