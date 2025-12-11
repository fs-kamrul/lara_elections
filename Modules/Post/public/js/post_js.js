/******/ (() => { // webpackBootstrap
/*!****************************************!*\
  !*** ./Resources/assets/js/post_js.js ***!
  \****************************************/
$(document).ready(function () {
  var $grid = $("#blog-posts-grid");
  var $noResults = $("#no-results");
  var $detailShow = $(".detail_show"); // ✅ select the detail section

  // store filters in one place
  var filters = {
    type: "All",
    category: "All",
    search: "",
    date: "All"
  };
  function loadPosts() {
    $.ajax({
      // url: window.location.href, // same route
      url: 'get_post_data',
      method: "GET",
      data: filters,
      beforeSend: function beforeSend() {
        $grid.html('<div class="col-12 text-center py-5">Loading...</div>');
      },
      success: function success(response) {
        // ✅ Hide full article detail when using AJAX load
        $detailShow.hide();
        if (response.data.trim().length === 0) {
          $grid.html("");
          $noResults.show();
        } else {
          $grid.html(response.data);
          $noResults.hide();
        }
      },
      error: function error() {
        $grid.html('<div class="col-12 text-center py-5 text-danger">Error loading posts.</div>');
      }
    });
  }

  // --- Type Filter ---
  $("#post-type-filter a").on("click", function (e) {
    e.preventDefault();
    $("#post-type-filter a").removeClass("active");
    $(this).addClass("active");
    filters.type = $(this).data("type");
    loadPosts();
  });

  // --- Category Filter ---
  $("#category-filter a").on("click", function (e) {
    e.preventDefault();
    $("#category-filter li").removeClass("active");
    $(this).parent().addClass("active");
    filters.category = $(this).data("category");
    loadPosts();
  });

  // --- Search Filter ---
  $("#search-input").on("keyup", function () {
    filters.search = $(this).val();
    loadPosts();
  });
  // --- Archive Filter ---
  $("#archive-filter a").on("click", function (e) {
    e.preventDefault();
    $("#archive-filter li").removeClass("active");
    $(this).parent().addClass("active");
    filters.date = $(this).data("date"); // new filter key
    loadPosts();
  });
});
/******/ })()
;