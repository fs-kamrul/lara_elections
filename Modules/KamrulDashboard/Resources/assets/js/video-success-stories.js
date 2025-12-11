(function ($) {
    'use strict';

    const VideoSuccessStories = {
        init() {
            this.wrapper = $('.video-success-stories-form-wrap');
            this.accordion = $('#accordion-video-stories');
            this.template = $('#template-video-story').html();

            // ✅ Use preloaded stories or empty array
            this.videos = window.videoSuccessStories?.videos || [];

            // ✅ Start index after preloaded stories
            this.index = this.videos.length;

            this.renderExistingVideos();
            this.bindEvents();
        },

        bindEvents() {
            const self = this;

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

        renderExistingVideos() {
            const self = this;

            if (self.videos.length > 0) {
                self.videos.forEach((video, index) => {
                    self.addStory(video, index);
                });
            }
        },

        addStory(video = {}, customIndex = null) {
            const self = this;

            // ✅ Use passed index if re-rendering, else auto-increment
            const index = customIndex !== null ? customIndex : self.index++;

            let html = self.template
                .replace(/__index__/g, index)
                .replace(/__index_display__/g, index + 1)
                .replace(/__id__/g, video.id || '')
                .replace(/__youtube_url__/g, video.youtube_url || '')
                .replace(/__text_story__/g, video.text_story || '')
                .replace(/__user_name__/g, video.user_name || '')
                .replace(/__user_designation__/g, video.user_designation || '');

            self.accordion.append(html);
            self.updateAccordionLabels();
        },

        updateAccordionLabels() {
            $('#accordion-video-stories .accordion-item').each(function (i) {
                const header = $(this).find('.accordion-button');
                const userName = $(this).find('input[name*="[user_name]"]').val() || 'N/A';
                header.html(`Story #${i + 1}: ${userName}`);
            });
        }
    };

    $(document).ready(function () {
        if ($('.video-success-stories-form-wrap').length) {
            VideoSuccessStories.init();
        }
    });
})(jQuery);
