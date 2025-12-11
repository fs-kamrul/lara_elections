/******/ (() => { // webpackBootstrap
/*!***********************************************!*\
  !*** ./Resources/assets/js/event_category.js ***!
  \***********************************************/
document.addEventListener("DOMContentLoaded", function () {
  var categoryButtons = document.querySelectorAll("#event-category-filters button");
  var typeButtons = document.querySelectorAll("#event-type-filters button");
  var categorySelect = document.querySelector("#category-select");
  var typeSelect = document.querySelector("#type-select");
  var eventsGrid = document.querySelector("#all-events-grid");
  var activeCategory = "All";
  var activeType = "All";
  function loadEvents(category, type) {
    var url = "event"; // Or use route('events') if named route exists
    var params = new URLSearchParams();
    if (category !== "All") {
      params.append("category_ids[]", category);
    }
    if (type !== "All") {
      params.append("admin_types_id", type); // ✅ better to keep consistent naming
    }
    fetch(url + "?" + params.toString(), {
      headers: {
        "X-Requested-With": "XMLHttpRequest"
      }
    }).then(function (res) {
      return res.json();
    }).then(function (data) {
      if (data.data) {
        eventsGrid.innerHTML = data.data;
      }
    });
  }

  // Category buttons (desktop)
  categoryButtons.forEach(function (button) {
    button.addEventListener("click", function () {
      categoryButtons.forEach(function (btn) {
        return btn.classList.remove("btn-brand-violet", "shadow-sm");
      });
      categoryButtons.forEach(function (btn) {
        return btn.classList.add("btn-outline-secondary");
      });
      this.classList.remove("btn-outline-secondary");
      this.classList.add("btn-brand-violet", "shadow-sm");
      activeCategory = this.dataset.category;
      loadEvents(activeCategory, activeType);
    });
  });

  // Type buttons (desktop)
  typeButtons.forEach(function (button) {
    button.addEventListener("click", function () {
      typeButtons.forEach(function (btn) {
        return btn.classList.remove("btn-brand-violet", "shadow-sm");
      });
      typeButtons.forEach(function (btn) {
        return btn.classList.add("btn-outline-secondary");
      });
      this.classList.remove("btn-outline-secondary");
      this.classList.add("btn-brand-violet", "shadow-sm");
      activeType = this.dataset.type;
      loadEvents(activeCategory, activeType);
    });
  });

  // Mobile category select
  categorySelect.addEventListener("change", function () {
    activeCategory = this.value;
    loadEvents(activeCategory, activeType);
  });

  // Mobile type select
  typeSelect.addEventListener("change", function () {
    activeType = this.value;
    loadEvents(activeCategory, activeType);
  });
});
/******/ })()
;