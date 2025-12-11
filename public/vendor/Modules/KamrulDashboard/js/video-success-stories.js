/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!******************************************************!*\
  !*** ./Resources/assets/js/video-success-stories.js ***!
  \******************************************************/
(function ($) {
  'use strict';

  var VideoSuccessStories = {
    init: function init() {
      var _window$videoSuccessS;
      this.wrapper = $('.video-success-stories-form-wrap');
      this.accordion = $('#accordion-video-stories');
      this.template = $('#template-video-story').html();

      // ✅ Use preloaded stories or empty array
      this.videos = ((_window$videoSuccessS = window.videoSuccessStories) === null || _window$videoSuccessS === void 0 ? void 0 : _window$videoSuccessS.videos) || [];

      // ✅ Start index after preloaded stories
      this.index = this.videos.length;
      this.renderExistingVideos();
      this.bindEvents();
    },
    bindEvents: function bindEvents() {
      var self = this;

      // Add new story
      self.wrapper.on('click', '.add-new-video-story', function () {
        self.addStory();
      });

      // Remove story
      self.wrapper.on('click', '.remove-video-story', function () {
        $(this).closest('.accordion-item').remove();
        self.updateAccordionLabels();
      });
    },
    renderExistingVideos: function renderExistingVideos() {
      var self = this;
      if (self.videos.length > 0) {
        self.videos.forEach(function (video, index) {
          self.addStory(video, index);
        });
      }
    },
    addStory: function addStory() {
      var video = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : {};
      var customIndex = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : null;
      var self = this;

      // ✅ Use passed index if re-rendering, else auto-increment
      var index = customIndex !== null ? customIndex : self.index++;
      var html = self.template.replace(/__index__/g, index).replace(/__index_display__/g, index + 1).replace(/__id__/g, video.id || '').replace(/__youtube_url__/g, video.youtube_url || '').replace(/__text_story__/g, video.text_story || '').replace(/__user_name__/g, video.user_name || '').replace(/__user_designation__/g, video.user_designation || '');
      self.accordion.append(html);
      self.updateAccordionLabels();
    },
    updateAccordionLabels: function updateAccordionLabels() {
      $('#accordion-video-stories .accordion-item').each(function (i) {
        var header = $(this).find('.accordion-button');
        var userName = $(this).find('input[name*="[user_name]"]').val() || 'N/A';
        header.html("Story #".concat(i + 1, ": ").concat(userName));
      });
    }
  };
  $(document).ready(function () {
    if ($('.video-success-stories-form-wrap').length) {
      VideoSuccessStories.init();
    }
  });
})(jQuery);
/******/ })()
;